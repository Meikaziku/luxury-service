<?php

namespace App\Controller;

use App\Repository\StatutCategoryRepository;

use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Entity\StatutCategory;
use App\Form\CandidatureType;
use App\Repository\CandidatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/candidature')]
final class CandidatureController extends AbstractController
{

    #[Route('/apply/{id}', name: 'app_candidature_apply', methods: ['GET'])]
    public function apply(
        JobOffer $jobOffer,
        EntityManagerInterface $entityManager,
        StatutCategoryRepository $statutCategoryRepository // <-- repository
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */
        $user = $this->getUser();
        $candidat = $user->getCandidat();

        if (!$candidat) {
            $this->addFlash('danger', 'Vous devez créer votre profil candidat avant de postuler.');
            return $this->redirectToRoute('app_profil');
        }

        if (!$candidat->isComplete()) {
            $this->addFlash(
                'warning',
                'Votre profil candidat est incomplet. Merci de le compléter avant de postuler.'
            );
            return $this->redirectToRoute('app_profil');
        }

        // Vérifie les doublons
        $existing = $entityManager->getRepository(Candidature::class)->findOneBy([
            'candidat' => $candidat,
            'jobOffer' => $jobOffer,
        ]);

        if ($existing) {
            $this->addFlash('info', 'Vous avez déjà postulé à cette offre.');
            return $this->redirectToRoute('app_job_offer_show', [
                'id' => $jobOffer->getId()
            ]);
        }

        // Création candidature
        $candidature = new Candidature();
        $candidature->setCandidat($candidat);
        $candidature->setJobOffer($jobOffer);
        $candidature->setCreatedAt(new \DateTimeImmutable());

        // ⚡ Assigner le statut par défaut
        $statut = $statutCategoryRepository->findOneBy(['statut' => 'En attente']); // Repository ici
        if (!$statut) {
            throw new \LogicException('Le statut "En attente" doit exister dans la base.');
        }
        $candidature->setStatut($statut);

        $entityManager->persist($candidature);
        $entityManager->flush();

        $this->addFlash('success', 'Candidature envoyée avec succès !');

        return $this->redirectToRoute('app_job_offer_show', [
            'id' => $jobOffer->getId()
        ]);
    }

    #[Route(name: 'app_candidature_index', methods: ['GET'])]
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_candidature_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($candidature);
            $entityManager->flush();

            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidature/new.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_show', methods: ['GET'])]
    public function show(Candidature $candidature): Response
    {
        return $this->render('candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_candidature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidature $candidature, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_delete', methods: ['POST'])]
    public function delete(Request $request, Candidature $candidature, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $candidature->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($candidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
    }
}
