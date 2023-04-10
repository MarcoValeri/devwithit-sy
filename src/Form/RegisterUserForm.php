<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'             => false,
                'attr'              => ['placeholder'   => 'Email*'],
                'required'          => true,
                'invalid_message'   => 'Error: email address not valid'
            ])
            ->add('roles', ChoiceType::class, [
                'label'     => 'Roles',
                'required'  => true,
                'expanded' => true,
                'multiple'  => true,
                'choices'   => [
                    'ROLE_ADMIN' => 'ROLE_ADMIN'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'required'          => true,
                'first_options'     => ['label' => false, 'attr' => ['placeholder'   => 'Password']],
                'second_options'    => ['label' => false, 'attr' => ['placeholder'   => 'Password Repeat']]
            ])
            ->add('register', SubmitType::class)
            ->getForm();
    }
}