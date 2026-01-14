<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class CandidatController extends AbstractController
{
    

    #[Route('/profil', name: 'app_profil', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, CandidatRepository $candidatRepository): Response
    {
        $candidat = $candidatRepository->findOneBy(['user' => $this->getUser()]);
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidat->setUpdatedAt(new \DateTimeImmutable());
            $this->handleFileUploads($form, $candidat);
            $entityManager->persist($candidat);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_candidat_delete', methods: ['POST'])]
    // public function delete(Request $request, Candidat $candidat, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->getPayload()->getString('_token'))) {
    //         $entityManager->remove($candidat);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
    // }

    private function handleFileUploads($form, Candidat $candidat): void
    {
        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/candidat/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Handle CV upload
        $cvFile = $form->get('cv')->getData();
        if ($cvFile instanceof UploadedFile) {
            $cvFileName = uniqid('cv_') . '.' . $cvFile->guessExtension();
            $cvFile->move($uploadDir, $cvFileName);
            $candidat->setCv('uploads/candidat/' . $cvFileName);
        }

        // Handle Passport file upload
        $passportFile = $form->get('passport_file')->getData();
        if ($passportFile instanceof UploadedFile) {
            $passportFileName = uniqid('passport_') . '.' . $passportFile->guessExtension();
            $passportFile->move($uploadDir, $passportFileName);
            $candidat->setPassportFile('uploads/candidat/' . $passportFileName);
        }

        // Handle Profile picture upload
        $pictureFile = $form->get('profil_picture')->getData();
        if ($pictureFile instanceof UploadedFile) {
            $pictureFileName = uniqid('profil_') . '.' . $pictureFile->guessExtension();
            $pictureFile->move($uploadDir, $pictureFileName);
            $candidat->setProfilPicture('uploads/candidat/' . $pictureFileName);
        }
    }
}
