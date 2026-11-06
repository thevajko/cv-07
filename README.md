# VAII cvičenie 07

Momentálne je otvorená vetva __MASTER__, ktorá obsahuje _štartér_. Riešenie obsahuje vetva __SOLUTION__.

## Úlohy

Východiskom je aplikácia z cvičenia 06.

1. Pridajte kontrolu na strane servera (obidva povinné polia, obrázok je len typu jpg, alebo png a text má aspoň 5
   znakov). Zdrojový kód pre metódu na kontrolu chýb vo formulári nájdete v súbore `formErrors.snippet.php`.
    1. Zmeňte vo formulári pole pre obrázok na typ `file` a doplňte `enctype="multipart/form-data"`.
    2. Skopírujte metódu `formErrors()` do kontrolera `PostController` a zavolajte ju v akcii `save()`.
    3. Ak sú vo formulári chyby, príspevok neukladajte a znovu zobrazte formulár aj s chybami.
    4. Upravte pohľad s formulárom tak, aby zobrazoval chyby.
2. Zmeňte formulár pre pridávanie a editáciu príspevkov tak, aby bolo možné nahrať obrázok z počítača. Obrázok sa má
   uložiť do adresára `public\uploads` a v DB sa má uložiť len jeho názov. Obrázok sa má zobraziť v zozname príspevkov.
    1. Vytvorte adresár `public\uploads` (cesty sú v konštantách `UPLOAD_DIR` a `UPLOAD_URL` v `Configuration`).
       Nezabudnite nastaviť pre adresár (rekurzívne) práva na zápis pre všetkých (Linux a WSL).
    2. V modeli `Post` odstráňte `picture` z `$fillable`.
    3. V akcii `save()` uložte nahraný súbor pod unikátnym názvom a do príspevku uložte len tento názov.
    4. Pri úprave a mazaní príspevku zmažte z disku aj pôvodný obrázok.
    5. V zozname príspevkov zložte adresu obrázka z konštanty `UPLOAD_URL` a názvu súboru.
    6. Zmažte pôvodné príspevky z DB (obsahujú URL adresy obrázkov).
3. Pridanie lajkovania k príspevkom
    1. Spustite SQL skript `snippets\ddl.likes_01.sql`.
    2. Vytvorte nový model `Like` a pridajte atribúty podľa DB tabuľky.
    3. Pridajte si do aplikácie ikony z bootstrapu.
    4. Doplňte v príspevku tlačidlo na lajkovanie (Bootstrap ikona) s počtom lajkov.
    5. Uložte lajk bez ohľadu na to, koľkokrát používateľ klikol na príspevok.
    6. Zobrazte počet lajkov pri každom príspevku.

# Použitý framework

Cvičenie používa framework vaííčko dostupný na
repe [https://github.com/thevajko/vaiicko](https://github.com/thevajko/vaiicko)

