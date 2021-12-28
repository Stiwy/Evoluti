<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Adresse e-mail *'
                ]
            ])
            ->add('company', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de l\'entreprise'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom *'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom *'
                ]
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'placeholder' => 'Téléphone *'
                ]
            ])
            ->add('mobile', TelType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Portable'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse *'
                ]
            ])
            ->add('address_complement', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Complément d\'adresse'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville *'
                ]
            ])
            ->add('zip_code', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Code postal *'
                ]
            ])
            ->add('country', CountryType::class, [
                'data' => 'FR'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'w-full px-3 py-2 border-2 border-blue-500 text-blue-500 rounded-md shadow-md hover:bg-blue-500 hover:text-white'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
