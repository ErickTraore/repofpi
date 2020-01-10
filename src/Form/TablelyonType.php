<?php

namespace App\Form;

use App\Entity\Tablelyon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TablelyonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ROLE_SYMPATHISANT' => 'ROLE_SYMPATHISANT',
                    'ROLE ADHERENT' => 'ROLE_ADHERENT',
                    'ROLE_MANAGER'   => 'ROLE_MANAGER',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                ],
                'preferred_choices' => ['muppets', 'ROLE_SYMPATHISANT'],
            ])
            ->add('titre')
            
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tablelyon::class,
        ]);
    }
}
