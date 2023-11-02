# VAII cvičenie 06
Momentálne je otvorená vetva __SOLUTION__, ktorá obsahuje _riešenie_. _Štartér_ obsahuje vetva __MAIN__.
Ak chcete vyskúšať riešenie, je potrebné v __Docker Desktop__ zmazať _stack_ __vaii_cv06__, aby sa vám správne inicializovala DB.

## Úlohy

Vytvorte jednoduchú aplikáciu, kde bude možné uverejňovať príspevky skladajúce sa z textu a fotografie. Implementujte všetky CRUD operácie. 

1. Vytvorenie modelu pre entitu `Post`.
   1. Použite SQL skript `ddl.posts_01.sql` na vytvorenie DB tabuľky v DB `vaiicko_db`.
   2. Do tabuľky vložte aspoň dva riadky. Obrázok môže byť externá URL.
   3. Vytvorte triedu pre model `Post` s atribútmi, ako má tabuľka.
2. Zobrazenie príspevkov
   1. Zobrazte príspevky na `Home` stránke.
   2. Načítajte záznamy o príspevkoch z DB a pošlite ich do pohľadu.
   3. Použite snippet `snippets/post.snippet.view.php` a upravte ho tak, aby zobrazila všetky príspevky z DB.
3. Pridávanie príspevkov
   1. Pre príspevky vytvorte nový controller `PostController`.
   2. Pridajte metódu pre zobrazenie formuláru na vloženie nového príspevku `add()`.
   3. Pridajte odkaz na pridanie príspevku do hlavného menu.
   4. Vytvorte jednoduchý HTML formulár pre pridanie príspevku do samostatného pohľadu `form.view.php`. Obrázok vkladajte ako text externej URL.
      Doplňte správnu akciu pre formulár.
   5. Nahraďte obsah pohľadu formulárom zo súboru `snippets\post-form.snippet.view.php`.
   6. Vytvorte pohľad `add.view.php`. Vhodne rozdeľte obsah pohľadu `form.view.php`, aby bolo možné použiť formulár opakovane.
   7. Doplňte metódu `save()` pre uloženie dát z formulára do DB a po jeho uložení presmerujte používateľa na `Home` stránku.
   8. Pridajte kontrolu na strane servera, že používateľ odoslal obidva povinné polia. Upravte pohľad s formulárom tak, aby zobrazoval chyby.
4. Editácia príspevku
   1. Nastavte správnu akciu k tlačidlu `Upraviť` pri zobrazení príspevku.
   2. Vytvorte metódu `edit()` a pohľad `edit.view.php`.
   3. Na editáciu použite formulár pre pridávanie príspevkov. Formulár upravte tak, aby zobrazoval dáta príspevku, ktorý upravujete. Nezabudnite, že pri
      editácii potrebujete aj id príspevku.
5. Zmazanie príspevku
   1. Nastavte správnu akciu k tlačidlu `Upraviť` pri zobrazení príspevku.
   2. Vytvorte metódu `delete()`. Po zmazaní príspevku, presmerujte zobrazenie na `Home` stránku.
6. Upload obrázka
   1. Upravte formulár tak, aby bolo možné odosielať súbor s obrázkom. Nezabudnite pridať atribút `enctype="multipart/form-data"` do značky `<form>`.
   2. Spracujte poslané súbory tak, aby sa ukladali na webový server do adresára `public\uploads`. Adresár je potrebné vytvoriť. V prípade OS Linux je potrebné
      aj nastaviť práva na zápis pre všetkých.
   3. Upravte zobrazenie príspevkov tak, aby sa zobrazovali obrázky, ktoré ste nahrali.
   4. Zabezpečte, aby sa nestávalo, že používatelia si budú prepisovať obrázky, ak majú rovnaký názov.

## Ako nájsť vetvu môjho cvičenia?
Pokiaľ sa chcete dostať k riešeniu z cvičenia je potrebné otvoriť si príslušnú _vetvu_, ktorej názov sa skladá:

__MIESTNOST__ + "-" + __HODINA ZAČIATKU__ + "-" + __DEN__

Ak teda navštevujete cvičenie pondelok o 08:00 v RA323, tak sa vaša vetva bude volať: __RA323-08-PON__

# Použitý framework
Cvičenie používa framework vaííčko dostupný na repe [https://github.com/thevajko/vaiicko](https://github.com/thevajko/vaiicko)
