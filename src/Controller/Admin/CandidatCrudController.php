<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class CandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidat::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Candidats')
            ->setEntityLabelInSingular('Candidat')
            ->setDefaultSort(['updated_at' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Prénom / Nom
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),

            // Email depuis User
            EmailField::new('user.email', 'Email'),

            // Ville
            TextField::new('currentLocation', 'Ville'),

            // Secteur d'activité
            TextField::new('jobCategory', 'Secteur d\'activité'),

            // Disponibilité / expérience
            AssociationField::new('experience', 'Disponibilité'),

            // Date d'inscription
            DateTimeField::new('updatedAt', 'Date d\'inscription')
                ->hideOnForm(),
        ];
    }
}
