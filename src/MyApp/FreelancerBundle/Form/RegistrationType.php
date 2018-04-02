<?php

namespace MyApp\FreelancerBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array('label' => 'firstName', 'translation_domain' => 'FOSUserBundle'))
            ->add('lastName', TextType::class, array('label' => 'lastName', 'translation_domain' => 'FOSUserBundle'))
            ->add('birthDate', TextType::class, array('label' => 'birthDate', 'translation_domain' => 'FOSUserBundle'))
            ->add('phoneNumber', TextType::class, array('label' => 'phoneNumber', 'translation_domain' => 'FOSUserBundle'))
            ->add('address', TextType::class, array('label' => 'address', 'translation_domain' => 'FOSUserBundle'))
            ->add('registrationNum', TextType::class, array('label' => 'registrationNum', 'translation_domain' => 'FOSUserBundle'))
            ->add('disponibility', TextType::class, array('label' => 'disponibility', 'translation_domain' => 'FOSUserBundle'))
            ->add('activitySector', TextType::class, array('label' => 'activitySector', 'translation_domain' => 'FOSUserBundle'))
            ->add('socialRaison', TextType::class, array('label' => 'socialRaison', 'translation_domain' => 'FOSUserBundle'))
            ->add('cv', TextType::class, array('label' => 'cv', 'translation_domain' => 'FOSUserBundle'))
            ->add('skills', TextType::class, array('label' => 'Skills', 'translation_domain' => 'FOSUserBundle'))
            ->add('domaine', TextType::class, array('label' => 'Domaine', 'translation_domain' => 'FOSUserBundle'))
            ->add('roles',ChoiceType::class,
                array('label' => ' ','choices' => array(
                    'ROLE_FREELANCER' => 'ROLE_FREELANCER',
                    'ROLE_JOBOWNER' => 'ROLE_JOBOWNER'),
                    'choices_as_values' => true,'multiple'=>true,'expanded'=>false));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
