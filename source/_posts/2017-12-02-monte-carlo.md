---
date: 2017-12-02 12:00
title: Monte Carlo
tags: [mentoring, monte_carlo]
categories: [php, nauka]


---
Metoda Monte Carlo wzięła swoją nazwę od dzielnicy kasyn w Monako.
Metoda ta pozwala modelować złożone zagadnienia dzięki wykonaniu wystarczająco dużej próby losowych badań.
<!-- more -->

Przykładem zastosowania tej metody jest obliczanie liczby pi. 
Doświadczenie to polega na badaniu, czy punkt (x, y) znajduje się wewnątrz okręgu o promieniu 1. 
Losuje się dwie liczby z zakresu 0–1 (x, y). Następnie liczy się odległość tego punktu od środka układu współrzędnych. 
Jeśli promień jest mniejszy/równy 1, uznajemy, że należy do okręgu. 
W efekcie otrzymujemy proporcję punktów będących powierzchnią ćwiartki koła. 
Teraz wystarczy podstawić tę wartość do wzoru na powierzchnię koła i przekształcić wzór, by otrzymać liczbę pi 
(S - pole koła, s - pole ćwiartki koła, r = 1).

$$   S = \pi r^2  $$
$$   s = {\pi r^2 \over 4}  $$
$$   \pi = 4s $$
$$   s = {hit \over attempts} < 1 $$

Napisz prosty program, w którym zbadasz dokładność tak otrzymanej liczby pi w funkcji ilości prób.

Przy okazji poczytaj o generatorach liczb pseudolosowych i ich wpływie na bezpieczeństwo.
W PHP mamy trochę za uszami w tej kwestii. Funkcja rand() jest powszechnie uznawana za niewystarczająco bezpieczną. 
Nie powinno się jej wykorzystywać do kwestii związanych z bezpieczeństwem, takich jak generowanie *soli*. 
Od PHP 7 dostępne są lepsze generatory liczb pseudolosowych: random_bytes i random_int.

Przy okazji przeczytaj o zacieraniu haseł i stosowaniu soli.

To dość trywialny przykład. Nie ma sensu stosować tu żadnych obiektów, wystarczy podejście proceduralne.

Następnym razem postaramy się zamodelować bardziej złożony problem i skorzystać z funkcji statystycznych.