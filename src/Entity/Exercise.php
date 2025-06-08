<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null; // Nazwa ćwiczenia, np. "Wyciskanie sztangi na ławce płaskiej"

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null; // Szczegółowy opis techniki wykonania

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $muscleGroups = null; // Główne i pomocnicze grupy mięśniowe (np. rozdzielone przecinkami)

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $equipment = null; // Wymagany sprzęt (np. sztanga, hantle)

    // Gettery i settery

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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMuscleGroups(): ?string
    {
        return $this->muscleGroups;
    }

    public function setMuscleGroups(?string $muscleGroups): static
    {
        $this->muscleGroups = $muscleGroups;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(?string $equipment): static
    {
        $this->equipment = $equipment;

        return $this;
    }
}

