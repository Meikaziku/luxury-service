<?php

namespace App\Controller\Recruiter;

use App\Entity\Candidature;
use App\Entity\Users;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class CandidatureCrudController extends AbstractCrudController
{
    public function __construct(
        private EntityRepository $entityRepository
    ) {}

    public static function getEntityFqcn(): string
    {
        return Candidature::class;
    }

    /**
     * 🔒 Le recruteur ne voit que les candidatures
     * liées à SES job offers
     */
    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        /** @var Users $user */
        $user = $this->getUser();

        $client = $user->getClient();

        $qb = $this->entityRepository->createQueryBuilder(
            $searchDto,
            $entityDto,
            $fields,
            $filters
        );

        $qb
            ->join('entity.jobOffer', 'jo')
            ->andWhere('jo.client = :client')
            ->setParameter('client', $client);

        return $qb;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('created_at', 'Date de candidature'),

            AssociationField::new('candidat', 'Candidat')
                ->formatValue(function ($value) {
                    if (!$value) {
                        return '';
                    }

                    return sprintf(
                        '%s %s (%s)',
                        $value->getFirstname(),
                        $value->getLastname(),
                        $value->getUsers()->getEmail()
                    );
                }),

            AssociationField::new('jobOffer', 'Offre')
                ->formatValue(fn ($value) => $value?->getJobTitle()),

            AssociationField::new('statut', 'Statut'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        // Seuls les admins peuvent créer, modifier et supprimer
        if ($this->isGranted('ROLE_ADMIN')) {
            return $actions;
        }

        return $actions
            ->disable(Action::NEW, Action::EDIT, Action::DELETE);
    }
}