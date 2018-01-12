---
date: 2018-01-02 12:00
title: Jak wdrażać projekt na serwer
tags: [wdrozenie, poza_kodem, deployer]
categories: [php]

---
Czasy, w których opublikowanie nowej wersji aplikacji wiązało się ze skopiowaniem plików na serwer, 
już dawno minęły. Przyjrzyjmy się dostępnym narzędziom i strategom.
<!-- more -->

### Wymagania

Zastanówmy się najpierw, jakie cechy powinno mieć rozwiązanie do publikowania aplikacji.

- Jest proste w użyciu.
- Zapewnia możliwość cofnięcia zmian, jeśli wprowadzona wersja zawiera błędy.
- Pozwala wykonać dodatkowe czynności, takie jak migracja bazy danych czy zainstalowanie pakietów przez composer.
- Wspiera rozwiązania rozdzielające konfigurację od aplikacji. Chodzi mi o nieprzechowywanie zmiennych środowiska, 
takich jak dane dostępu do bazy danych, w repozytorium. Pliki konfiguracji powinny istnieć jedynie 
na serwerze, który ich potrzebuje.

### Problemy do rozwiązania

Najprostszym rozwinięciem metody kopiowania jest skorzystanie z systemu kontroli wersji. 
Niepodzielnym liderem jest w tym wypadku git wraz z publicznymi repozytoriami, jak GitHub lub BitBucket. 
Takie rozwiązanie pozwala cofnąć zmiany. Przy poprawnej konfiguracji pliki konfiguracyjne znajdują się 
na serwerze i pobranie nowej wersji ich nie uszkodzi.

Problemem są dodatkowe czynności. Przy każdym wdrożeniu powinniśmy sprawdzać, czy należy aktualizować 
pakiety lub bazę danych. Można to zrobić ręcznie lub stworzyć skrypt, który to zautomatyzuje. 
Takie czynności jednak zawsze trwają jakiś czas. Im bardziej rozbudowany system, tym dłużej. 
W tym czasie system może pracować niestabilnie lub być niedostępny.

Rozwiązaniem tego problemu jest tworzenie kopii projektu obok aktualnie działającego. Po wykonaniu 
wszelkich niezbędnych czynności, takich jak aktualizacja pakietów czy migracja bazy, następuje przepięcie 
katalogu, z którego korzysta serwer WWW.

Nie jest to niestety koniec problemów. Co z danymi aplikacji? Nie wszystkie dane są trzymane w bazie danych. 
Przechowywanie obrazów lub cache w bazie danych nie jest optymalne. Istnieje oczywiście możliwość korzystania 
z zewnętrznych usług, takich jak Redis czy AWS S3. Nie zawsze jednak mamy możliwość skorzystania z takich rozwiązań.

### Narzędzia

Jak widzisz, jest sporo problemów. A jako że są to problemy powtarzalne i dość uniwersalne, 
na pewno istnieją odpowiednie narzędzia, które pomogą w ich rozwiązaniu. Jest [Capistrano](http://capistranorb.com/) 
napisany w Ruby. Są receptury do Ansible. Jest też [Deployer](https://deployer.org/) napisany w PHP.

Ich głównym zadaniem jest stworzenie szkieletu procesu wdrożenia. Są one oparte na podobnej koncepcji. 
Istnieje instrukcja, w jakiej kolejności mają być wykonane kroki wdrożenia. Podobny jest nawet układ katalogów:

- shared: tu znajdą się pliki współdzielone między wersjami aplikacji, wszystkie pliki konfiguracji związane 
z tą instancją serwera, pliki wgrane przez użytkowników;
- releases: kolejne wdrożone wersje aplikacji; tu będzie się znajdować aplikacja z podlinkowanymi 
plikami z katalogu shared;
- current: link do aktualnej wersji w releases.

### Co wykonuje takie narzędzie? 

Łączy się z serwerem (lub serwerami) poprzez SSH. Tworzy nowy katalog w releases. 
Pobiera do niego najnowszą wersję projektu z repozytorium. Instaluje composer i pobiera zależności 
zgodnie z plikiem composer.lock projektu. Linkuje pliki z katalogu shared. Czyści nadmiarowe pliki, 
np. pliki związane z testami lub środowiskiem deweloperskim. Rozgrzewa cache, czyli wykonuje czynności 
związane z pierwszym uruchomieniem. W projekcie opartym na Symfony będzie to przepisanie konfiguracji 
z plików .yml i adnotacji do plików .php.
Uruchomienie dodatkowych skryptów, takich jak migracja bazy danych czy generowanie 
zminimalizowanych plików .CSS i JS nastąpi po przygotowaniu aplikacji. Jeśli wszystkie zaplanowane czynności 
zakończą się powodzeniem, nastąpi przepięcie katalogu current, aby wskazywał na najnowszą wersję aplikacji.

### Które narzędzie wybrać?

Logika i sposób działania tych narzędzi są podobne, powielają sprawdzoną strategię. 
Z tego powodu wpływ na decyzję mogą mieć cechy drugorzędne.

- Jak dobrze znasz język, w którym zostało napisane narzędzie? Ja z tego powodu wybrałem Deployera.
- Czy środowisko docelowe wspiera odpowiednie technologie? W jednym z projektów klient miał 
problem ze swoim środowiskiem. Chmura, w której miała być hostowana aplikacja, doliczała znaczną opłatę 
za użycie Ruby na serwerze.

### Jak mi się korzysta z Deployer-a?

Przez dłuższy czas korzystałem z Capistrano, choć dość odtwórczo, bez zgłębiania, jak on działa. 
Wtedy był to pewien standard przy projektach opartych na Symfony. Miałem z nim problemy, którymi na szczęście 
zajął się ktoś inny.

Ten blog jest zbudowany na generatorze stron statycznych. Musiałem dopisać jedno zadanie, by strony generowały
 się w wersji produkcyjnej na serwerze. Prosta jednolinijkowa komenda.
 
Na moim hostingu (po taniości) natrafiłem na pewien problem. Na serwerze istnieje kilka wersji PHP. 
Niestety dla CLI domyślnie jest wersja 5.2 (!). Nie chciała ona współpracować z aplikacją 
(tworząc ją, korzystałem z wersji 7.1). Mimo pomocy helpdesku hostingu Deployer łączył się 
w trybie bez zastosowanej łaty. Na szczęście jest on wysoce konfigurowalny. Wymusiłem więc konkretną wersję PHP, 
dodając dla danej maszyny konfigurację ze ścieżką do oczekiwanej wersji PHP.

### Do poczytania

Przeczytaj o Continuous Integration. To temat szerszy niż sam proces wdrożenia. Jest to raczej kolejny 
krok w automatyzacji pracy i narzędzia takie jak Deployer są jego częścią.
