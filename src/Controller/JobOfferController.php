<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Entity\Users;
use App\Form\JobOfferType;
use App\Repository\CandidatureRepository;
use App\Repository\JobCategoryRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/job-offer')]
final class JobOfferController extends AbstractController
{
    #[Route(name: 'app_job_offer_index', methods: ['GET'])]
    public function index(
        JobOfferRepository $jobOfferRepository,
        JobCategoryRepository $jobCategoryRepository
    ): Response {
        return $this->render('job_offer/index.html.twig', [
            'job_offers' => $jobOfferRepository->findAll(),
            'categories' => $jobCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_job_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobOffer);
            $entityManager->flush();

            return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_offer/new.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_offer_show', methods: ['GET'])]
    public function show(
        JobOffer $jobOffer,
        CandidatureRepository $candidatureRepository,
        JobOfferRepository $jobOfferRepository
    ): Response {
        /** @var User|null $user */
        $user = $this->getUser();
        $hasAlreadyApplied = false;

        if ($user instanceof Users && $user->getCandidat()) {
            $candidat = $user->getCandidat();

            $hasAlreadyApplied = $candidatureRepository->findOneBy([
                'jobOffer' => $jobOffer,
                'candidat' => $candidat,
            ]) !== null;
        }

        // ⬅️ Offre précédente
        $previous = $jobOfferRepository->createQueryBuilder('j')
            ->andWhere('j.id < :id')
            ->setParameter('id', $jobOffer->getId())
            ->orderBy('j.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        // ➡️ Offre suivante
        $next = $jobOfferRepository->createQueryBuilder('j')
            ->andWhere('j.id > :id')
            ->setParameter('id', $jobOffer->getId())
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $this->render('job_offer/show.html.twig', [
            'job_offer' => $jobOffer,
            'hasAlreadyApplied' => $hasAlreadyApplied,
            'previous' => $previous,
            'next' => $next,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_job_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobOffer $jobOffer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_offer/edit.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_offer_delete', methods: ['POST'])]
    public function delete(Request $request, JobOffer $jobOffer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $jobOffer->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($jobOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}
