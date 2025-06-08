<?php

namespace App\Form;

use App\Entity\Exercise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa ćwiczenia',
                'attr' => ['placeholder' => 'Np. Wyciskanie sztangi']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis',
                'attr' => ['rows' => 5, 'placeholder' => 'Szczegółowy opis techniki wykonania']
            ])
            ->add('muscleGroups', TextType::class, [
                'label' => 'Grupy mięśniowe',
                'required' => false,
                'attr' => ['placeholder' => 'Np. klatka piersiowa, triceps']
            ])
            ->add('equipment', TextType::class, [
                'label' => 'Wymagany sprzęt',
                'required' => false,
                'attr' => ['placeholder' => 'Np. sztanga, ławka']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}


