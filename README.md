
# PHP-CRUD-school-system

Ova aplikacija predstavlja CRUD sistem za ucenike i skole. Sastoji se od tri glavne stranice: na jednoj su prikazani ucenici (index.php), na drugoj skole (skole.php) i na trecoj statistika starosne strukture ucenika u skolama (statistika.php). 
Tu su jos dvije stranice na kojima se prikazuju detalji za jednog selektovanog ucenika (details_ucenici.php) i detalji za jednu selektovanu skolu (details_skole.php).

Koriscene tehnologije su: PHP, MySql, jQuery, Bootstrap i AJAX.

---------------------------------------------------------------------------------------------------------------------------

1. Stranica Ucenici:

- dodavanje ucenika (vrsi se ajax validacija na uneseno ime i prezime (polja su required, ne smiju biti prazna))

- pregled ucenika sa opcijama edit, detalji ucenika, brisanje ucenika (ovo za svakog ucenika) i paginacija

- pretraga ucenika (ajax pozivi za prikaz suggestion-a)


2. Stranica Skole:

- dodavanje skole (vrsi se ajax validacija na JIB broj (polje je required, broj mora imati tacno 8 cifara i ne smije vec postojati u evidenciji))

- pregled skola sa opcijama edit, detalji skole, brisanje skole (ovo za svaku skolu) i paginacija

- pretraga skola (ajax pozivi za prikaz suggestion-a)


3. Stranica Statistika:

- pregled starosne strukture ucenika po skolama(brojno stanje po kategorijama i procentualno ucesce u ukupnom broju ucenika(prikazane cetiri skole))

- ajax pozivi za ucitavanje ostalih skola (cetiri skole po pozivu)


4. Stranica Podaci ucenika:

- prikaz podataka za pojedinacnog ucenika, pristup preko opcije details za svakog ucenika


5. Stranica Podaci skole:

- prikaz podataka za pojedinacnu skolu, pristup preko opcije details za svaku skolu

- ajax pozivi za ucitavanje ucenika koji pohadjaju izabranu skolu (prikaz podataka ucenika sa opcijama details, edit i delete)


