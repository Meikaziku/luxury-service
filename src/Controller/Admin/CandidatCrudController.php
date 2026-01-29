<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

// ...existing code...

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

    public function configureActions(Actions $actions): Actions
    {
        // Seuls les admins peuvent créer, modifier et supprimer
        if ($this->isGranted('ROLE_ADMIN')) {
            return $actions;
        }

        return $actions
            ->disable(Action::NEW, Action::EDIT, Action::DELETE);
    }


    public function configureFields(string $pageName): iterable
    {
        $fields =  [
            // Prénom / Nom
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom'),

            // Email depuis User
            EmailField::new('users.email', 'Email'),

            // Ville
            TextField::new('currentLocation', 'Ville'),

            // Secteur d'activité
            TextField::new('jobCategory', 'Secteur d\'activité'),

            // Disponibilité / expérience
            AssociationField::new('experience', 'Disponibilité'),

            // Photo de profil
            ImageField::new('profilPicture', 'Photo de profil')
                ->setRequired(false)
                ->onlyOnDetail(),


            // Date d'inscription
            DateTimeField::new('updatedAt', 'Date d\'inscription')
                ->hideOnForm(),
        ];

        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $fields[] = UrlField::new('cv', 'CV')
                ->setTemplatePath('admin/candidat/cv_link.html.twig');
            $fields[] = UrlField::new('passportFile', 'Passeport')
                ->setTemplatePath('admin/candidat/passport_link.html.twig')
                ->hideOnIndex();
        }

        return $fields;
    }


    
}
