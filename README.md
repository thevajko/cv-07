# VAII cvičenie 07
Momentálne je otvorená vetva __MAIN__, ktorá obsahuje _štartér_. _Riešenie_ obsahuje vetva __SOLUTION__.

## Úlohy
Upravte aplikáciu z minulého cvičenia tak, aby sa používateľ musel najskôr prihlásiť, ak chcete pridávať, upravovať alebo zmazať príspevok. Pridajte autorizáciu akcií, aby používateľ mohol upravovať a zmazať len svoj príspevok. Doplňte funkciu na lajkovanie príspevkov.

1. Prihlasovanie
   1. Vytvorte potomka triedy `DummyAuthenticator` a upravte proces prihlásenia tak, aby bol používateľ prihlásený, ak sa jeho login a heslo rovnajú.
   2. Upravte nastavenia aplikácie tak, aby sa používal nový spôsob prihlásenia.
   3. V menu položku Pridať príspevok zobrazte iba prihláseným používateľom.
   4. Pre neprihlásených skryte tlačidlá na pridanie a zmazanie príspevku.
   5. Zabezpečte, aby sa príspevky zobrazovali aj na Home stránke v Admin časti aplikácie.
   6. Všetky akcie v `Post` kontroléri sa budú zobrazovať iba pre prihlásených používateľov.
2. Zobrazenie autora príspevku
   1. Spustite SQL skript `snippets\ddl.posts_01_alter.sql`, aby sa vytvoril nový stĺpec v DB.
   2. Upravte model pre príspevok tak, aby obsahoval aj login jeho autora.
   3. Autora zobrazte v príspevkoch na `Home` page.
   4. Autora ukladajte pri pridávaní nového príspevku.
3. Pridanie autorizácie
   1. Upravte akcie na úpravu a zmazanie príspevku tak, aby ho mohol upraviť/zmazať len jeho autor.
4. Pridanie lajkovania k príspevkom
   1. Spustite SQL skript `snippets\ddl.likes_01.sql`.
   2. Vytvorte nový model `Like` a pridajte atribúty podľa DB tabuľky.
   3. Doplňte v príspevku tlačidlo na lajkovanie s počtom lajkov. Lajkovanie povoľte len prihláseným používateľom.
   4. Uloźte lajk bez ohľadu na to, koľko krát používateľ klikol na príspevok.
   5. Zobrazte počet lajkov pri každom príspevku.
   6. Upravte aplikačnú logiku lajkovania. Jeden používateľ môže lajknúť príspevok len raz. Ak ho "lajkne" znovu, lajk sa zruší.

## Ako nájdem vetvu môjho cvičenia?
Pokiaľ sa chcete dostať k riešeniu z cvičenia je potrebné otvoriť si príslušnú _vetvu_, ktorej názov sa skladá:

__MIESTNOST__ + "-" + __HODINA ZAČIATKU__ + "-" + __DEN__

Ak teda navštevujete cvičenie pondelok o 08:00 v RA323, tak sa vaša vetva bude volať: __RA323-08-PON__

# Použitý framework
Cvičenie používa framework vaííčko dostupný na repe [https://github.com/thevajko/vaiicko](https://github.com/thevajko/vaiicko)
