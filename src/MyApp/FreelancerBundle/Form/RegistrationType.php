<?php
// src/AppBundle/Form/RegistrationType.php

namespace MyApp\FreelancerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName', TextType::class, array('label' => 'form.FirstName', 'translation_domain' => 'FOSUserBundle'))
            ->add('LastName', TextType::class, array('label' => 'form.LastName', 'translation_domain' => 'FOSUserBundle'))
            ->add('birthDate', TextType::class, array('label' => 'birthDate', 'translation_domain' => 'FOSUserBundle'))
            ->add('phoneNumber', TextType::class, array('label' => 'phoneNumber', 'translation_domain' => 'FOSUserBundle'))
            ->add('address', TextType::class, array('label' => 'address', 'translation_domain' => 'FOSUserBundle'))
            ->add('registrationNum', TextType::class, array('label' => 'registrationNum', 'translation_domain' => 'FOSUserBundle'))
            ->add('disponibility', TextType::class, array('label' => 'disponibility', 'translation_domain' => 'FOSUserBundle'))
            ->add('activitySector', TextType::class, array('label' => 'activitySector', 'translation_domain' => 'FOSUserBundle'))
            ->add('socialRaison', TextType::class, array('label' => 'socialRaison', 'translation_domain' => 'FOSUserBundle'))
            ->add('cv', FileType::class, array('label' => 'Curriculum Vitae (PDF file)','data_class' => null))
            ->add('skills', TextType::class, array('label' => 'Skills', 'translation_domain' => 'FOSUserBundle'))
            ->add('domaine', TextType::class, array('label' => 'Domaine', 'translation_domain' => 'FOSUserBundle'))
            ->add('roles',ChoiceType::class,
                array('label' => ' ','choices' => array(
                    'ROLE_FREELANCER' => 'ROLE_FREELANCER',
                    'ROLE_JOBOWNER' => 'ROLE_JOBOWNER'),
                    'choices_as_values' => true,'multiple'=>true,'expanded'=>false))



        ;
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}