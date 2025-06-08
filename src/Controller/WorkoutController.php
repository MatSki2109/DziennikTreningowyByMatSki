<?php

namespace App\Controller;

use App\Entity\Workout;
use App\Entity\WorkoutExercise; // Upewnij się, że ta linia jest dodana
use App\Form\WorkoutType;
use App\Repository\WorkoutRepository;
use App\Repository\UserRepository; // Do tymczasowego pobierania użytkownika
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface; // Użyj tego, gdy uwierzytelnianie będzie gotowe

#[Route('/workout')]
class WorkoutController extends AbstractController
{
    // Akcja listująca wszystkie plany treningowe
    #[Route('/', name: 'app_workout_index', methods: ['GET'])]
    public function index(WorkoutRepository $workoutRepository): Response
    {
        // Tymczasowo: pobierz wszystkie treningi.
        // Po zaimplementowaniu Security, możesz pobrać treningi dla zalogowanego użytkownika:
        // $user = $this->getUser();
        // if (!$user) {
        //     throw $this->createAccessDeniedException('Musisz być zalogowany, aby przeglądać treningi.');
        // }
        // $workouts = $workoutRepository->findBy(['user' => $user]);

        $workouts = $workoutRepository->findAll(); // Tymczasowo dla testów

        return $this->render('workout/index.html.twig', [
            'workouts' => $workouts,
        ]);
    }

    // Akcja do tworzenia nowego planu treningowego
    #[Route('/new', name: 'app_workout_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $workout = new Workout();

        // Tymczasowo: przypisz trening do pierwszego znalezionego użytkownika lub stwórz fikcyjnego
        // Po zaimplementowaniu Security, użyj: $user = $this->getUser();
        $user = $userRepository->find(1); // Zakładamy, że masz użytkownika z ID 1
        if (!$user) {
            // Możesz stworzyć fikcyjnego użytkownika dla testów, jeśli baza danych jest pusta
            $user = new \App\Entity\User();
            $user->setEmail('test@example.com');
            $user->setPassword(password_hash('password', PASSWORD_BCRYPT)); // Haszowanie hasła jest ważne!
            $user->setRoles(['ROLE_USER']);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('info', 'Utworzono użytkownika testowego.');
        }
        $workout->setUser($user);


        // Dodaj jedno puste ćwiczenie do formularza, aby użytkownik mógł od razu zacząć dodawać
        $workout->addWorkoutExercise(new WorkoutExercise());


        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($workout);
            $entityManager->flush();

            $this->addFlash('success', 'Plan treningowy został pomyślnie utworzony!');

            return $this->redirectToRoute('app_workout_index');
        }

        return $this->render('workout/new.html.twig', [
            'workout' => $workout,
            'form' => $form,
        ]);
    }

    // Akcja do wyświetlania szczegółów pojedynczego planu treningowego
    #[Route('/{id}', name: 'app_workout_show', methods: ['GET'])]
    public function show(Workout $workout): Response
    {
        // Sprawdź, czy użytkownik ma dostęp do tego treningu (po zaimplementowaniu Security)
        // if ($workout->getUser() !== $this->getUser()) {
        //     throw $this->createAccessDeniedException('Nie masz dostępu do tego treningu.');
        // }

        return $this->render('workout/show.html.twig', [
            'workout' => $workout,
        ]);
    }

    // Akcja do edycji istniejącego planu treningowego
    #[Route('/{id}/edit', name: 'app_workout_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workout $workout, EntityManagerInterface $entityManager): Response
    {
        // Sprawdź, czy użytkownik ma dostęp do tego treningu (po zaimplementowaniu Security)
        // if ($workout->getUser() !== $this->getUser()) {
        //     throw $this->createAccessDeniedException('Nie masz dostępu do edycji tego treningu.');
        // }

        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Plan treningowy został pomyślnie zaktualizowany!');

            return $this->redirectToRoute('app_workout_index');
        }

        return $this->render('workout/edit.html.twig', [
            'workout' => $workout,
            'form' => $form,
        ]);
    }

    // Akcja do usuwania planu treningowego
    #[Route('/{id}', name: 'app_workout_delete', methods: ['POST'])]
    public function delete(Request $request, Workout $workout, EntityManagerInterface $entityManager): Response
    {
        // Sprawdź, czy użytkownik ma dostęp do tego treningu (po zaimplementowaniu Security)
        // if ($workout->getUser() !== $this->getUser()) {
        //     throw $this->createAccessDeniedException('Nie masz dostępu do usunięcia tego treningu.');
        // }

        if ($this->isCsrfTokenValid('delete'.$workout->getId(), $request->request->get('_token'))) {
            $entityManager->remove($workout);
            $entityManager->flush();

            $this->addFlash('success', 'Plan treningowy został pomyślnie usunięty!');
        } else {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania planu treningowego.');
        }


        return $this->redirectToRoute('app_workout_index');
    }
}

