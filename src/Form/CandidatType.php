<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\ExperienceCategory;
use App\Entity\Gender;
use App\Entity\JobCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('passport_file', FileType::class, [
                'label' => 'Passport File (PDF)',
                'required' => false,
                'constraints' => [
                    new File(
                        maxSize: '5M',
                        mimeTypes: ['application/pdf'],
                        mimeTypesMessage: 'Please upload a valid PDF document',
                    )
                ],
                'mapped' => false,
            ])
            ->add('cv', FileType::class, [
                'label' => 'CV (PDF)',
                'required' => false,
                'constraints' => [
                    new File(
                        maxSize: '5M',
                        mimeTypes: ['application/pdf'],
                        mimeTypesMessage: 'Please upload a valid PDF document',
                    )
                ],
                'mapped' => false,
            ])
            ->add('profil_picture', FileType::class, [
                'label' => 'Profile Picture (Image)',
                'required' => false,
                'constraints' => [
                    new File(
                        maxSize: '5M',
                        mimeTypes: [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/webp',
                        ],
                        mimeTypesMessage: 'Please upload a valid image file',
                    )
                ],
                'mapped' => false,
            ])
            ->add('current_location')
            ->add('date_of_birth')
            ->add('place_of_birth')
            ->add('gender_type', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'sexe',
            ])
            ->add('short_description')
            ->add('job_category', EntityType::class, [
                'class' => JobCategory::class,
                'choice_label' => 'name',
            ])
            ->add('experience', EntityType::class, [
                'class' => ExperienceCategory::class,
                'choice_label' => 'experience',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
