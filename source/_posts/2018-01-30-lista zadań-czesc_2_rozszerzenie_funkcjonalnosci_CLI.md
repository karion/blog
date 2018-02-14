---
date: 2018-01-30 12:00
title: Lista zadań - część 2 ()rozszerzenie funkcjonalności CLI)
tags: [mentoring, projekt]
categories: [php, nauka]
---
Mamy już działającą aplikację. Tylko dlaczego klient nie jest zadowolony? 
To normalne, że po pierwszej implementacji wychodzą braki w specyfikacji.
<!-- more -->

Dobrze jest je wyłapać jeszcze przed implementacją. Nie zawsze jednak jest to możliwe. 
W tym projekcie najbardziej niedopracowany był ostatni punkt „Możliwość oznaczania zadania jako wykonanego”. 
Nie ma w nim żadnej informacji o tym, jak mają się zachowywać zakończone zadania.

- Czy dalej ma być wyświetlane?
- Czy ma być przechowywane?
- Czy data zakończenia ma być przechowywana?

To tylko kilka pytań, które możemy zadać. Podobnie do wcześniejszych punktów można zadać pytania, 
by lepiej zrozumieć potrzeby klienta.

- Jak ma wyglądać lista, a jak widok szczegółowy zadania?
- Czy przechowywać dodatkowe dane, takie jak data utworzenia?

### Agile

Metody gibkie jak Scrum kładą duży nacisk na dialog z klientem. Mamy być specjalistami, którzy pomogą 
klientowi odkryć najlepszy sposób na realizację jego potrzeb.

Zbyt często skupiamy się na konkretnym zadaniu, a tracimy szerszy kontekst. 
Dużym problemem jest w tym wypadku proces “wychowania” programistów. Na początku drogi młodemu 
programiście są powierzane zadania końcowe. Nie uczestniczy on w procesie analizy wymagań i 
poszukiwania rozwiązania. Dodanie kolejnej kontrolki w formularzu jest esencją takich zadań.

W Scrumie kładzie się nacisk na udział całego zespołu w procesie definiowania zadań. 
Nawet jeśli czujesz, że nie wnosisz dodatkowej wartości jako młody programista, to nie znaczy, że jesteś tam zbędny. 
Po pierwsze, możesz poznać kontekst, który pomoże ci zrozumieć zadanie. Po drugie, odkrywasz, 
jak zadania są definiowane na podstawie potrzeb, czyli poznajesz prawdziwy warsztat programisty. 
Po trzecie, masz świeże spojrzenie na problem. Rutyna jest zgubna w tym zawodzie, zbyt często naginamy 
projekt do naszych przyzwyczajeń, zamiast się rozwijać i dawać klientowi jak najszersze spektrum rozwiązań.

### Aplikacja

Rozwiń aplikację zgodnie z dodatkowymi założeniami:

- Zadania zakończone nie są wyświetlane na liście zadań.
- Jest zapisywana data utworzenia zadania i jego zakończenia.
- Zadania zakończone mają być przechowywane.
- Lista zadań ma być sortowana według daty utworzenia od najstarszych.
- Lista zakończonych zadań ma być sortowana według daty zakończenia od najnowszych.
- Na liście zadań mają być wyświetlane jedynie numer i tytuł.
- Na liście zadań zakończonych mają być wyświetlane numer, data zakończenia i tytuł.

