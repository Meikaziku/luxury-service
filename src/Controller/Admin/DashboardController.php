<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use App\Entity\Client;
use App\Entity\JobOffer;
use App\Repository\CandidatRepository;
use App\Repository\CandidatureRepository;
use App\Repository\ClientRepository;
use App\Repository\JobOfferRepository;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route as AttributeRoute;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private CandidatRepository $candidatRepository,
        private ClientRepository $clientRepository,
        private JobOfferRepository $jobOfferRepository,
        private CandidatureRepository $candidatureRepository,
    ) {}

    #[AttributeRoute('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'countCandidats'     => $this->candidatRepository->count([]),
            'countClients'       => $this->clientRepository->count([]),
            'countJobOffers'     => $this->jobOfferRepository->count([]),
            'countApplications' => $this->candidatureRepository->count([]),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Service');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Candidats', 'fa fa-user', Candidat::class);
        yield MenuItem::linkToCrud('Clients', 'fa fa-user', Client::class);
        yield MenuItem::linkToCrud('Job Offers', 'fa fa-user', JobOffer::class);
    }
}
