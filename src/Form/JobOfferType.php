<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\JobCategory;
use App\Entity\JobOffer;
use App\Entity\JobType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('description')
            ->add('isActive')
            ->add('jobTitle')
            ->add('jobLocation')
            ->add('closingAt', null, [
                'widget' => 'single_text'
            ])
            ->add('salary')
            ->add('createdAt', null, [
                'widget' => 'single_text'
            ])
            ->add('slug')
            ->add('jobType', EntityType::class, [
                'class' => JobType::class,
                'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => JobCategory::class,
                'choice_label' => 'id',
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
