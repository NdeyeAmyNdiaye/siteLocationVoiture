<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CarFleet;
use App\Entity\Engines;
use App\Entity\Gears;
use App\Entity\Model;
use App\Entity\Seats;
use App\Entity\Brands;
use App\Entity\Cars;
use Symfony\Component\OptionsResolver\OptionsResolver;



class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $carFleet=
        $builder
            ->add('price')
            ->add('availability')
            ->add('plate')
            ->add('carFleet', EntityType::class,
            ['class' => CarFleet::class,
             'choice_label' => 'status',
             'label' => 'Statut'
            ])
            ->add('seat', EntityType::class,
            ['class' => Seats::class,
             'choice_label' => 'seat',
             'label' => 'Nombre de place '
            ])
            ->add('engine', EntityType::class,
            ['class' => Engines::class,
             'choice_label' => 'engine',
             'label' => 'Motorisation '
            ])
            ->add('brand', EntityType::class,
            ['class' => Brands::class,
             'choice_label' => 'brand',
             'label' => 'Marque'
            ])
            ->add('gear', EntityType::class,
            ['class' => Gears::class,
             'choice_label' => 'gear',
             'label' => 'Boite de vitesse'
            ])
            ->add('model', EntityType::class,
            ['class' => Model::class,
             'choice_label' => 'model',
             'label' => 'Modéle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
