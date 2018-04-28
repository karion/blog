---
date: 2018-04-28 12:00
title: Piekiełko mikroserwisów
tags: [microservice, problems, logging, monitoring]
categories: [php]
---
Mikroserwisy to kolejny buzzword, który dotknął IT. Kilka dużych firm, jak Netflix, 
opisało, jak mikroserwisy stały się rozwiązaniem ich problemów. A my rzuciliśmy się,
 by wdrażać je do naszych systemów.
<!-- more -->

Zapomnieliśmy tylko, że mikroserwisy są narzędziem. Narzędziem, które powinno rozwiązywać 
konkretne problemy. A większość naszych systemów nie ma takich problemów z wydajnością jak Netflix.

Mikroserwisy wiążą się także z wysokim progiem wiedzy, który musi mieć zespół. 
I nie chodzi mi o wiedzę stricte techniczną, bo mikroserwisy w warstwie technologicznej 
są dość proste, aż za proste. Problemem jest wiedza domenowa. 
Trzeba posiadać dogłębną wiedzę o modelowanym systemie, by potrafić zidentyfikować zależności 
między rozdzielanymi kontekstami.

### Wymagania

W artykule [Microservice Prerequisites](https://martinfowler.com/bliki/MicroservicePrerequisites.html) 
możemy przeczytać o wymaganiach, które stawia 
Martin Fowler. Są to:

- monitoring wszystkiego, co się da;
- automatyzacja:
  - wdrożenia i jego wycofywania,
  - tworzenia i likwidowania instancji mikroserwisu.

Dodałbym jeszcze znajomość DDD i domeny przez osoby odpowiedzialne za identyfikację i definiowanie mikroserwisów.

### Problemy

Ja w swojej przygodzie z mikroserwisami napotkałem kilka problemów. Główną przyczyną problemów, 
na które natrafiliśmy jako zespół, był wymóg uzupełniania żądania o dane spoza kontekstu danego mikroserwisu. 
Efektem tego była duża liczba żądań między mikroserwisami. To powodowało problemem z identyfikacją 
żądań będących efektem jednej akcji użytkownika. Szczególnie uciążliwe stało się to, gdy zaczęliśmy 
mieć problemy z wydajnością spowodowane zaimplementowaniem problemu 1 + N.


### Rozwiązania

Dzięki zastosowaniu agregatora logów (Kibana) mieliśmy wszystkie logi, zarówno z serwera, jak i z aplikacji, 
zebrane w jednym miejscu. Problemem było zidentyfikowanie, które wpisy pochodzą z diagnozowanego żądania. 
Dlatego na poziomie serwera zaczęliśmy dodawać do nagłówka HTTP dodatkowy identyfikator 
w postaci wygenerowanego losowo ciągu znaków.

Oczywiście taki znacznik to za mało. Zbudowaliśmy system przekazywania tego znacznika do logów 
i kolejnych podżądań. W efekcie udało się przypisać wszystkie logi do oryginalnego żądania.

Dzięki temu mogliśmy efektywnie wyszukiwać żądania generujące duże liczby podżądań, 
a nawet duże liczby zapytań do baz danych.

### Trochę kodu


Middleware zgodny z PSR

Klasa dla monologa

