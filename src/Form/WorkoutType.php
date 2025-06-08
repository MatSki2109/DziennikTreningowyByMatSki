<?php

namespace App\Form;

use App\Entity\Workout;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa treningu',
                'attr' => ['placeholder' => 'Np. Trening A - Klatka/Triceps']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis (opcjonalnie)',
                'required' => false,
                'attr' => ['rows' => 3, 'placeholder' => 'Szczegółowy opis lub cel treningu']
            ])
            ->add('workoutExercises', CollectionType::class, [
                'entry_type' => WorkoutExerciseType::class, // Zagnieżdżony formularz dla każdego ćwiczenia
                'allow_add' => true, // Pozwala na dodawanie nowych pól JavaScriptem
                'allow_delete' => true, // Pozwala na usuwanie pól JavaScriptem
                'by_reference' => false, // Ważne dla relacji OneToMany, aby Doctrine dobrze zarządzało kolekcją
                'label' => false, // Nie wyświetla domyślnej etykiety dla kolekcji
                'entry_options' => ['label' => false], // Nie wyświetla etykiet dla zagnieżdżonych formularzy
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workout::class,
        ]);
    }
}


