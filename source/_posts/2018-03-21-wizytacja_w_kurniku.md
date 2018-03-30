---
date: 2018-03-21 7:00
title: Wizytacja w kurniku
tags: [mentoring, monte_carlo]
categories: [nauka, php]
---
W ramach ćwiczeń napisałem swoją analizę gry “Pełny kurnik”, jednak moje rozwiązanie nie jest idealne. 
Już pisząc ten kod, czułem, że coś jest nie tak. Dopiero po kilku tygodniach zrozumiałem co.
<!-- more -->

### Znalezione błędy

Kod na branchu [first try](https://github.com/karion/chickencoop/tree/first_try) jest zapisem, gdzie poprzednio 
skończyłem pracę. Większość strategii jest zaimplementowana. Dzięki temu udało mi się uzyskać piękne 
wykresy pokazujące, że wymiana na&nbsp;koguta się nie opłaca. Nie jest to jednak kod, z którego jestem dumny. 
Zastosowane rozwiązanie uwierało mnie już w trakcie pisania, ale wtedy nie miałem czasu, by zrozumieć dlaczego.

Po czasie udało mi się zauważyć błędy w projekcie. Najważniejszym, mającym ogromny wpływ na następne 
było przyjęcie tylko dwóch wariantów decyzji w klasie strategii: rzut albo wymiana. 
W&nbsp;zeczywistości, czy raczej w grze, mamy pięć możliwości:

- rzut kośćmi,
- wymiana na koguta,
- wymiana na kurę,
- wymiana na kurczaka,
- wywrócić stół i sobie pójść (choć tego akurat nie implementuję).

Ponieważ bardzo mocno związałem się ze swoimi dwoma wariantami, pomieszałem w klasach 
komunikację i odpowiedzialność. Klasa Strategii powinna odpowiadać jedynie za wybór wariantu. 
W&nbsp;moim rozwiązaniu natomiast odpowiadała też za dokonanie zmian w obiekcie Kurnika. 
W&nbsp;komunikacji z obiektem Gra Strategia wysyłała informację, czy udało się wykonać wymianę, 
a powinna wskazać jedynie, co ma być zrobione. Już pisząc kod, wiedziałem, że&nbsp;łamię zasadę SOLID, 
tylko że nie potrafiłem się wyrwać ze swojego schematu myślowego.

### Poprawki

Przeniosłem do Gry wszelkie operacje na Kurniku. Strategia ma jedynie wywołać odpowiednie metody Gry, 
zależnie od stanu Kurnika i swojej logiki. Wszystkie statystyki są przechowywane w&nbsp;Grze i generowane 
podczas operacji na Kurniku.

To, że Strategia wywołuje metody Gry na żądanie Gry, może być na początku trochę dziwne, ale to normalna
interakcja między obiektami. Ten pomysł zaczerpnąłem ze wzorca “wizytator”, choć nie jest to jego 
poprawne zastosowanie.


Moje drugie podejście możesz znaleźć na branchu [fix_design](https://github.com/karion/chickencoop/tree/fix_design).

### Wzorce projektowe

No właśnie, wzorce projektowe – czym one są? To zbiór rozwiązań problemów napotykanych podczas projektowania 
aplikacji obiektowych. W trakcie pracy często natrafiamy na problemy powodujące dużą komplikację kodu. 
Wielopoziomowe if-y, przekazywanie jakichś dziwnych zmiennych między metodami i&nbsp;przeładowanie argumentów 
metod to częste objawy tego, że tracimy z oczu prawdziwy problem.

Wzorce projektowe pomagają nam go rozwiązać. Proponują strukturę obiektów porządkującą odpowiedzialności i 
komunikację między nimi. Wzorzec “strategia” pozwala rozdzielić logikę zależnie od rodzaju przekazanego obiektu. 
Zamiast budować kod wciąż sprawdzający, z jakim obiektem ma do czynienia, budujemy obiekt strategii obsługujący 
tylko jeden rodzaj obiektu wejściowego. Sprawdzenie i wybór odpowiedniej strategii następuje przed wywołaniem metody. 
Może to się dziać np. w jakimś agregacie strategii zawierającym logikę dopasowania odpowiedniej strategii do&nbsp;obiektu.

Takich wzorców jest wiele. Ułatwiają nam one pracę, więc dobrze je znać. Należy jednak pamiętać, że niektóre 
z nich nie przetrwały próby czasu. Wzorzec “singleton” miał być rozwiązaniem na zmienne globalne. 
Z czasem okazało się, że tylko przejął ich role, a nie rozwiązał problemu zależności i odwołań 
do zmiennych globalnych.