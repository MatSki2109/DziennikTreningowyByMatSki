<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Form\ExerciseType;
use App\Repository\ExerciseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/exercise')]
class ExerciseController extends AbstractController
{
    // Akcja listująca wszystkie ćwiczenia w atlasie
    #[Route('/', name: 'app_exercise_index', methods: ['GET'])]
    public function index(ExerciseRepository $exerciseRepository): Response
    {
        return $this->render('exercise/index.html.twig', [
            'exercises' => $exerciseRepository->findAll(), // Pobiera wszystkie ćwiczenia
        ]);
    }

    // Akcja do tworzenia nowego ćwiczenia
    #[Route('/new', name: 'app_exercise_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exercise = new Exercise();
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request); // Obsługuje dane z formularza

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($exercise); // Przygotowuje encję do zapisu
            $entityManager->flush(); // Zapisuje encję do bazy danych

            $this->addFlash('success', 'Ćwiczenie zostało pomyślnie dodane do atlasu!');

            return $this->redirectToRoute('app_exercise_index'); // Przekieruj do listy ćwiczeń
        }

        return $this->render('exercise/new.html.twig', [
            'exercise' => $exercise,
            'form' => $form,
        ]);
    }

    // Akcja do wyświetlania szczegółów pojedynczego ćwiczenia
    #[Route('/{id}', name: 'app_exercise_show', methods: ['GET'])]
    public function show(Exercise $exercise): Response
    {
        return $this->render('exercise/show.html.twig', [
            'exercise' => $exercise,
        ]);
    }

    // Akcja do edycji istniejącego ćwiczenia
    #[Route('/{id}/edit', name: 'app_exercise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exercise $exercise, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExerciseType::class, $exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush(); // Aktualizuje encję w bazie danych

            $this->addFlash('success', 'Ćwiczenie zostało pomyślnie zaktualizowane!');

            return $this->redirectToRoute('app_exercise_index');
        }

        return $this->render('exercise/edit.html.twig', [
            'exercise' => $exercise,
            'form' => $form,
        ]);
    }

    // Akcja do usuwania ćwiczenia
    #[Route('/{id}', name: 'app_exercise_delete', methods: ['POST'])]
    public function delete(Request $request, Exercise $exercise, EntityManagerInterface $entityManager): Response
    {
        // Sprawdź token CSRF, aby zapobiec atakom
        if ($this->isCsrfTokenValid('delete'.$exercise->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exercise); // Usuwa encję
            $entityManager->flush();

            $this->addFlash('success', 'Ćwiczenie zostało pomyślnie usunięte!');
        } else {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania ćwiczenia.');
        }


        return $this->redirectToRoute('app_exercise_index');
    }
}


