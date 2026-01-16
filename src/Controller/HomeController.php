<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\JobOfferRepository;
use App\Repository\JobCategoryRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( JobOfferRepository $jobOfferRepository,
    JobCategoryRepository $jobCategoryRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'job_offers' => $jobOfferRepository->findAll(),
            'categories' => $jobCategoryRepository->findAll(),
        ]);
    }
}
