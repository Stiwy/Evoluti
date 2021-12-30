<?php

namespace App\Form;

use App\Entity\Mission;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre *'
                ]
            ])
            ->add('details', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Détails de la mission *'
                ]
            ])
            ->add('user', ChoiceType::class, [
                'choices' => $options['customers'],
            ])
            ->add('price', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Prix *'
                ]
            ])
            ->add('price_recurrency', ChoiceType::class, [
                'choices'  => [
                    'Heure' => 'Heure',
                    'Jour' => 'Jour',
                    'Semaine' => 'Semaine',
                    'Mois' => 'Mois',
                    'Année' => 'Année',
                    'Facture unique' => 'Facture unique',
                ],
                'data' => 'Jour'
            ])
            ->add('invoice_recurrency', ChoiceType::class, [
                'choices'  => [
                    'Heure' => 'Heure',
                    'Jour' => 'Jour',
                    'Semaine' => 'Semaine',
                    'Mois' => 'Mois',
                    'Année' => 'Année',
                    'Facture unique' => 'Facture unique',
                ],
                'data' => 'Mois',
                'help' => 'Facturer le client chaque ...'
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'A faire' => 'A faire',
                    'En cours' => 'En cours',
                    'En attente' => 'En attente',
                    'Payement en attente' => 'Payement en attente',
                    'A presenter au client' => 'A presenter au client',
                    'Terminé' => 'Terminé',
                ],
                'data' => 'A faire',
                'help' => 'Statut de la mission'
            ])
            ->add('invoice_deadline_date', DateType::class, [
                'widget' => 'single_text',
                'help' => 'Date de première facturation'
            ])
            ->add('start_mission_date', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'help' => 'Date du début de la mission'
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
            'data_class' => Mission::class,
            'customers' => array(),
        ]);
    }
}
