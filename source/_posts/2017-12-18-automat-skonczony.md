---
date: 2017-12-18 11:00
title: Automat skończony
tags: [finite_state_machine, event_sourcing]
categories: [php, biblioteki]

---
Automat skończony (ang. finite state machine) lub maszyna stanów to koncepcja, w której obiekt (maszyna) 
może się znajdować jedynie w określonych stanach. Najczęściej definiujemy także możliwe przejścia między 
konkretnymi stanami oraz to, który ze stanów jest początkowy, a który końcowy.
<!-- more -->

W programowaniu tę koncepcję realizujemy przeważnie w obiektach. Atrybuty takie jak status najczęściej oznaczają, 
że mamy do czynienia z maszynami stanu. Zazwyczaj nie wbudowujemy mechanizmów kontroli zmiany stanu (tylko między 
dozwolonymi tranzycjami). Wynika to zwykle ze stosowania anemicznego modelu danych, w którym kontrola jest realizowana 
poza obiektem (np. w serwisach lub handlerach command busa).

Z maszynami stanu jest także powiązane zagadnienie Event Sourcingu. To metoda, w której nie przechowuje się 
bieżącego stanu obiektu, ale historię zmian (tranzycji) między kolejnymi stanami. Aktualny stan obiektu 
uzyskuje się dzięki odtworzeniu stanu obiektów poprzez przejście przez wszystkie tranzycje. 
Ale o tym w następnych wpisach.

Istnieje wiele realizacji koncepcji maszyn stanu w PHP. Główna różnica to miejsce, w którym realizowana jest kontrola.

-   Biblioteka [yohang/finite](https://github.com/yohang/Finite) realizuje kontrolę nad stanem obiektu 
poprzez zewnętrzną klasę StateMachine. Obiekt tej klasy przechowuje całą konfigurację stanów i przejść. 
W celu zmiany stanu przekazujemy do maszyny stanu obiekt i nowy stan.
-   Z kolei [gomachan46/state-machine](https://github.com/gomachan46/StateMachine) użycie trait zamyka logikę 
wewnątrz obiektu. Konfiguracja obiektu odbywa się poprzez adnotacje, co jest o tyle dobre, że wiąże konfigurację 
z klasą obiektu.

Która metoda jest lepsza? To zależy od tego, jakie założenia ma spełniać rozwiązanie. 
Przy anemicznym modelu obiektu bardziej odpowiednie wydaje się pierwsze podejście. Logika jest poza obiektem. 
Maszyna stanu to tak właściwie serwis, którym zmieniamy stan obiektu. Jeśli chcemy przechowywać logikę w obiekcie, 
drugie podejście jest bardziej odpowiednie. Ja wolałbym jednak użyć kodu, a nie adnotacji, ale takie podejście też jest OK.




