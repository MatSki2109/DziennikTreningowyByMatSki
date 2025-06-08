<?php

namespace App\Entity;

use App\Repository\WorkoutExerciseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutExerciseRepository::class)]
class WorkoutExercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'workoutExercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Workout $workout = null; // Relacja ManyToOne do planu treningowego

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercise $exercise = null; // Relacja ManyToOne do ćwiczenia z atlasu

    #[ORM\Column(nullable: true)]
    private ?int $sets = null; // Liczba serii, np. 3

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reps = null; // Liczba powtórzeń, np. "8-12" lub "5x5"

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null; // Dodatkowe uwagi do ćwiczenia w tym treningu

    #[ORM\Column(nullable: true)]
    private ?int $orderInWorkout = null; // Kolejność ćwiczenia w treningu

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkout(): ?Workout
    {
        return $this->workout;
    }

    public function setWorkout(?Workout $workout): static
    {
        $this->workout = $workout;

        return $this;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getSets(): ?int
    {
        return $this->sets;
    }

    public function setSets(?int $sets): static
    {
        $this->sets = $sets;

        return $this;
    }

    public function getReps(): ?string
    {
        return $this->reps;
    }

    public function setReps(?string $reps): static
    {
        $this->reps = $reps;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getOrderInWorkout(): ?int
    {
        return $this->orderInWorkout;
    }

    public function setOrderInWorkout(?int $orderInWorkout): static
    {
        $this->orderInWorkout = $orderInWorkout;

        return $this;
    }
}

