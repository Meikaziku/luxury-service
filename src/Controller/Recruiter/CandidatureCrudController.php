<?php

namespace App\Controller\Recruiter;

use App\Entity\Candidature;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidature::class;
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

                    // 👉 adapte selon TON entity Candidat
                    return sprintf(
                        '%s %s (%s)',
                        $value->getFirstname(),
                        $value->getLastname(),
                        $value->getUser()->getEmail()
                    );
                }),

            AssociationField::new('jobOffer', 'Offre'),

            AssociationField::new('statut', 'Statut'),
        ];
    }
}
