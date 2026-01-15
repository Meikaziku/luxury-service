<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('JobOffer')
            ->setEntityLabelInSingular('JobOffer');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Prénom / Nom
            TextareaField::new('description', 'Description'),
            TextField::new('job_title', 'Intitulé du poste'),

            DateTimeField::new('created_at', 'Créé le')
                ->hideOnForm(), // généralement automatique à la création
            DateTimeField::new('closing_at', 'Date de fermeture'),

            BooleanField::new('is_active', 'Actif'),

            MoneyField::new('salary', 'Salaire')
                ->setCurrency('EUR'),

            AssociationField::new('job_type_id', 'Type de poste'),
            AssociationField::new('client_id', 'Client'),
            AssociationField::new('job_category_id', 'Catégorie d\'activité'),
        ];
    }
}
