<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'))
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
            ->add('username', null, array('label' => 'Username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'password'),
                'second_options' => array('label' => 'confirm password'),
                'invalid_message' => 'password mismatch',
            ))
            ->add('roles',ChoiceType::class,
                array('label' => ' ','choices' => array(
                    'ROLE_FREELANCER' => 'ROLE_FREELANCER',
                    'ROLE_JOBOWNER' => 'ROLE_JOBOWNER'),
                    'choices_as_values' => true,'multiple'=>true,'expanded'=>false))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'registration',
        ));
    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_registration';
    }
}
