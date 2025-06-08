<?php

namespace App\Form;

use App\Entity\Exercise;
use App\Entity\WorkoutExercise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('exercise', EntityType::class, [
                'class' => Exercise::class,
                'choice_label' => 'name', // Wyświetla nazwę ćwiczenia w liście wyboru
                'placeholder' => 'Wybierz ćwiczenie',
                'label' => 'Ćwiczenie',
                'attr' => ['class' => 'form-select']
            ])
            ->add('sets', IntegerType::class, [
                'label' => 'Serie',
                'required' => false,
                'attr' => ['min' => 1, 'placeholder' => 'Np. 3']
            ])
            ->add('reps', TextType::class, [
                'label' => 'Powtórzenia',
                'required' => false,
                'attr' => ['placeholder' => 'Np. 8-12 lub 5x5']
            ])
            ->add('notes', TextareaType::class, [
                'label' => 'Uwagi (opcjonalnie)',
                'required' => false,
                'attr' => ['rows' => 2, 'placeholder' => 'Np. "wolno opuszczać"']
            ])
            ->add('orderInWorkout', IntegerType::class, [
                'label' => 'Kolejność',
                'required' => false,
                'attr' => ['min' => 0],
                'help' => 'Ustaw kolejność ćwiczeń w treningu',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutExercise::class,
        ]);
    }
}


