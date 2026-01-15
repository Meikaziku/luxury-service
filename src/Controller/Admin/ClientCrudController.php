<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Client')
            ->setEntityLabelInSingular('Client');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Prénom / Nom
            TextField::new('society_name', 'Nom de la société'),
            TextField::new('activity_type', 'Type d\'activité'),
            TextField::new('contact_name', 'Nom du contact'),
            TextField::new('poste', 'Poste'),
            TelephoneField::new('contact_phone', 'Téléphone'),
            EmailField::new('contact_email', 'Email'),
        ];
    }
}
