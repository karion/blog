---
date: 2018-01-16 12:00
title: Lista zadań - część 1 (CLI)
tags: [mentoring, projekt, projekt_start]
categories: [php, nauka]
draft: true
---
Proste narzędzie, które ułatwia nam planowanie pracy. Jest tysiące implementacji tej idei. 
Czy można tu jeszcze coś wymyślić? Tylko właściwie po co? To narzędzie powinno być jak najprostsze.
<!-- more -->

To będzie pierwszy projekt. Duże zadanie rozbite na kilka mniejszych, tak jak najczęściej jest w pracy. 
Sprinty w Scrumie nastawione na dowiezienie nowej wartości.

### Założenia
Nie chcę tworzyć kolejnego narzędzia webowego. Ponieważ dużo pracuję z konsolą, potrzebuję aplikacji CLI. 
Ta aplikacja będzie rozwijana i pewnie rozrośnie się o inne interfejsy; postaraj się, by logika aplikacji 
była rozdzielona od interfejsu użytkownika.

W większości aplikacji używamy bazy danych do przechowywania danych. Może to być baza danych SQL, 
jak PostgreSQL, lub któreś z rozwiązań NoSQL, jak MongoDB. Są to jednak dodatkowe usługi, które stanowią 
pewien narzut dla aplikacji. Nasza aplikacja zaś ma być bardzo prosta. Stwórz system przechowywania danych w plikach.

#### Podsumowanie

- Interfejs użytkownika z wiersza poleceń konsoli.
- Dane zapisywane na dysku (jako zserializowane dane).
- Zadanie składa się z tytułu i opisu.
- Możliwość oznaczania zadania jako wykonanego.

### Do poczytania
Zapoznaj się z biblioteką do abstrakcji systemu plików. Kiedyś podstawą był system plików środowiska, w którym 
była uruchamiana aplikacja. Dziś królują chmury publiczne. Dobrze jest zastosować warstwę abstrakcji, która 
uniezależni nas od konkretnego zastosowania. Sprawdza się to szczególnie wtedy, gdy korzysta się z innych rozwiązań 
w środowisku deweloperskim (lokalne pliki) i produkcyjnym (AWS S3). Jedną z lepszych bibliotek jest [Flysystem](http://flysystem.thephpleague.com/) 
od ligi ([The League of Extraordinary Packages](http://thephpleague.com/)).

Podobnie serializacja i deserializacja danych mogą być problematyczne. 
[JMS Serializer](https://jmsyst.com/libs/serializer) to dojrzałe rozwiązanie pozwalające na precyzyjne 
sterowanie tym, jak obiekt ma być przekształcony i odtworzony.


