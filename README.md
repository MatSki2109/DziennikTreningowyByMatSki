Dziennik Treningowy by MatSki

Spis Treści:

  - O Projekcie
  - Funkcjonalności
  - Technologie
  - Zrzuty Ekranu
  - Dalszy Rozwój (Roadmap)


O PROJEKCIE:


Dziennik Treningowy to aplikacja webowa stworzona w oparciu o framework Symfony 7, mająca na celu wspieranie użytkowników w śledzeniu i zarządzaniu ich postępami na siłowni. Aplikacja umożliwia tworzenie spersonalizowanych planów treningowych w oparciu o wbudowany atlas ćwiczeń, zapisywanie wykonanych sesji oraz monitorowanie statystyk. Jest to idealne narzędzie dla każdego, kto chce uporządkować swoje treningi i efektywnie dążyć do celów fitness.



FUNKCJONALNOŚCI:


  Aplikacja oferuje następujące kluczowe funkcjonalności:



  - Atlas Ćwiczeń:


 1. Przeglądanie obszernej bazy danych ćwiczeń.
    

 2. Szczegółowe opisy ćwiczeń (technika, zaangażowane mięśnie, wymagany sprzęt).
    

 3. Dodawanie, edytowanie i usuwanie ćwiczeń (funkcjonalność dla administratora/użytkownika).

    

 - Dziennik Treningowy:

   

 1.Tworzenie Planów Treningowych: Budowanie niestandardowych planów treningowych z ćwiczeń dostępnych w atlasie.

 

 2.Definiowanie parametrów ćwiczeń: Ustawianie liczby serii, powtórzeń, uwag dla każdego ćwiczenia w planie.

 

 3.Zarządzanie Planami: Przeglądanie, edytowanie i usuwanie stworzonych planów.

 
 

 - Moduł Użytkownika (do pełnej implementacji):

   

 1.Rejestracja i logowanie użytkowników.

 

 2.Zarządzanie profilem.

 

 3.Historia Sesji Treningowych: Zapisywanie i przeglądanie wykonanych treningów.

 

 4.Statystyki i Wizualizacje: Wykresy postępów (np. ciężar, objętość) – planowane.

 


TECHNOLOGIE


Projekt został zbudowany z wykorzystaniem następujących technologii:



Backend:

 - PHP 8.2+

 - Symfony 7.2.6 (Framework)

 - Doctrine ORM (dla interakcji z bazą danych)

 - Composer (zarządzanie zależnościami PHP)



Baza Danych:


 - MySQL


Frontend:


 - HTML5

 - CSS3 (z wykorzystaniem frameworka Tailwind CSS)


JavaScript (dla interaktywnych elementów, np. dynamiczne dodawanie ćwiczeń w formularzu)



ZRZUTY EKRANU


Poniżej znajdują się zrzuty ekranu przedstawiające kluczowe funkcjonalności aplikacji.

Atlas Ćwiczeń
![image](https://github.com/user-attachments/assets/7cc0bc30-eaff-4c1e-a77c-f8a1e81a90f4)


Atlas Ćwiczeń (Formularz dodawania nowego ćwiczenia)
![image](https://github.com/user-attachments/assets/f7713704-7e65-4554-babd-90f8750947e6)


Szczegóły wybranego ćwiczenia
![image](https://github.com/user-attachments/assets/f385e41c-bd10-4261-9d7a-1995e3bd12cc)


Strona Główna Treningów
![image](https://github.com/user-attachments/assets/bac3bcb1-d421-432d-b6a6-4e91d0465f21)


Formularz Tworzenia Treningu
![image](https://github.com/user-attachments/assets/5abf8757-4ebf-4a95-854d-ee343039342b)


Szczegóły Utworzonego Treningu
![image](https://github.com/user-attachments/assets/ba3e6662-82c1-42d5-b88d-57082b6effbb)





Dalszy Rozwój (Roadmap)

Projekt jest w ciągłym rozwoju. 


Planowane funkcjonalności i ulepszenia to:


 1.Pełna implementacja modułu uwierzytelniania i autoryzacji użytkowników (rejestracja, logowanie, zarządzanie sesjami).


 2.Moduł "Historia Sesji Treningowych" - możliwość zapisywania faktycznie wykonanych treningów z danymi o ciężarze, powtórzeniach itp.


 3.Integracja z bibliotekami do wizualizacji danych (np. Chart.js) w celu prezentowania statystyk i postępów użytkownika.


 4.Większa responsywność i dostosowanie do urządzeń mobilnych.


 5.Możliwość dodawania zdjęć/filmów do ćwiczeń w atlasie.


 6.Filtrowanie i wyszukiwanie treningów.
