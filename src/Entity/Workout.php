<?php

namespace App\Entity;

use App\Repository\WorkoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutRepository::class)]
class Workout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null; // Nazwa planu treningowego, np. "Trening nóg"

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null; // Opis planu treningowego

    #[ORM\ManyToOne(inversedBy: 'workouts')]
    private ?User $user = null; // Relacja ManyToOne do użytkownika, który stworzył trening

    #[ORM\OneToMany(targetEntity: WorkoutExercise::class, mappedBy: 'workout', orphanRemoval: true, cascade: ['persist'])]
    private Collection $workoutExercises; // Relacja OneToMany do ćwiczeń w tym treningu

    public function __construct()
    {
        $this->workoutExercises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, WorkoutExercise>
     */
    public function getWorkoutExercises(): Collection
    {
        return $this->workoutExercises;
    }

    public function addWorkoutExercise(WorkoutExercise $workoutExercise): static
    {
        if (!$this->workoutExercises->contains($workoutExercise)) {
            $this->workoutExercises->add($workoutExercise);
            $workoutExercise->setWorkout($this);
        }

        return $this;
    }

    public function removeWorkoutExercise(WorkoutExercise $workoutExercise): static
    {
        if ($this->workoutExercises->removeElement($workoutExercise)) {
            // set the owning side to null (unless already changed)
            if ($workoutExercise->getWorkout() === $this) {
                $workoutExercise->setWorkout(null);
            }
        }

        return $this;
    }
}

