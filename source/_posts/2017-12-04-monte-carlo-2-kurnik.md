---
date: 2017-12-02 12:00
title: Monte Carlo 2 - Kurnik
tags: [mentoring, monte_carlo]
categories: [php, nauka]


---
Ponownie wykorzystamy metodę Monte Carlo, ale tym razem do bardziej życiowego problemu. Gram ze swoimi dziećmi w 
grę planszową „Pełny kurnik”. Jest to prosta gra o dużej losowości. Mimo to można w niej zastosować kilka strategii.
<!-- more -->

Problem tkwi w wyborze optymalnej strategii. Policzenie prawdopodobieństwa przy rzucie dwiema kośćmi K6 wydaje 
się proste, ale ze względu na możliwość kar za dublety i możliwość wymiany trudno by było to policzyć. 
Metoda Monte Carlo nadaje się do tego dość dobrze. Policzenie, w ilu ruchach uzyska się zwycięstwo, 
jest dla komputera operacją tanią. Powtórzenie tego wielokrotnie dalej będzie tanie.

Zasady znajdziesz tu: [instrukcja](http://olguska2plus3.blogspot.com/2017/01/peny-kurnik-instrukcja.html)

Co tu można poznać?

-   Pisząc aplikację, wymyśl mechanizm, który pozwoli ci testować wiele strategii. Podpowiedź: obiekty i interfejsy.
-   To będzie pewnie aplikacja konsolowa CLI. 
Zapoznaj się z jakąś biblioteką ułatwiającą tworzenie takich aplikacji. Najpopularniejszą jest obecnie symfony/console.
-   Poczytaj o funkcjach statystycznych w PHP. Do analizy wyników poza średnią przyda się pewnie też odchylenie standardowe.
-   Tablice nie są zbyt wydajne w PHP, szczególnie przy dużej liczbie danych. Zobacz, jakie klasy do przechowywania danych proponuje SPL.
