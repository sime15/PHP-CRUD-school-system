
# PHP-CRUD-school-system


Ova aplikacija predstavlja CRUD sistem za uncenike i skole. Sastoji se od tri glavne stranice: na jednoj su prikazani ucenici, na drugoj skole i na trecoj statistika starosne strukture ucenika u skolama. Tu su jos dvije stranice na kojima se prikazuju detalji za jednog selektovanog ucenika i detalji za jednu selektovanu skolu.

---------------------------------------------------------------------------------------------------------------------------

Prva stranica ili Home Page je Ucenici, odgovarajuci kod je smjesten u fajlu index.php. Na stranici se nalaze sljedeci elementi:

1. Blocquote element Bootstrapa.

2. Meni sa linkovanim poljima na stranice Ucenici, Skole i Statistika, pri cemu je oznaceno ono na kome se korisnik trenutno nalazi. Tu je i polje za pretragu ucenika. Pretraga se obavlja u fajlu index.php. Upotrijebljena je i AJAX tehnologija koja pruza 'interaktivnu' pretragu, odnosno prikazuje trenutno pronadjene ucenike cije ime ili prezime odgovara trenutno unesenom stringu. Pronadjeni ucenici se prikazuju u formi dropdown menija i njihova imena su linkovana na stranicu na kojoj se prikazuju podaci za pojedinacnog ucenika (fajl details_ucenici.php). Destinacija za AJAX poziv je fajl na serveru search_ucenici.php u kome se obavlja pretraga. Kod za meni se nalazi u fajlu main_menu.php.

3. Ispod menija se nalazi breadcrumbs traka koja prikazuje gdje se trenutno korisnik nalazi. Breadcrumbs su podeseni pojedinacno na svakoj stranici, a opsti kod je u fajlu breacrumbs.php.

4. Sljedeci element je dugme za unos novog ucenika u evidenciju. Klikom na dugme se podize modal sa poljima za unos podataka novog ucenika. I za ovu operaciju je upotrijebljena AJAX tehnologija. AJAX funkcija salje unesene podatke fajlu new_student.php na serveru. U tom fajlu se vrsi validacija podataka u smislu da je neophodno da su popunjena polja 'Ime' i 'Prezime'. Ukoliko ime ili prezime nisu uneseni, na vrhu modala ce se prikazati odgovarajuci alert. Ukoliko su ova polja popunjena ili se popune nakon upozorenja, ucenik ce biti upisan u bazu, na vrhu modala ce se prikazati odgovarajuce obavjestenje i korisnik ce biti preusmjeren na Home Page nakon dvije sekunde. Odgovarajuce obavjestenje ce biti prikazano i u slucaju kada su obavezna polja popunjena ali unos u bazu nije uspio i bice dopisana poruka koju vraca funkcija mysql_error().

5. Tabela sa ucenicima (inace, svi fajlovi su organizovani koriscenjem grid sistema Bootstrapa). U tabeli su prikazani ucenici sa svojim podacima i tri opcije za svakog ucenika: details, edit i delete. Klikom na slicicu details korisnik se usmjerava na fajl details_ucenici.php gdje su na osnovu id-ija ucenika prosljedjenog GET metodom prikazani detalji za trazenog ucenika u formi tabele. Klikom na slicicu edit, podize se modal sa poljima u kojima su upisani trenutni podaci ucenika. Nakon izmjene podataka i klika na 'Save Changes' edituju se podaci ucenika, sto je rijeseno u fajlu index.php. Ukoliko je ucenik uspjesno editovan iznad tabele ce se prikazati alert koji obavjestava korisnika. Ukoliko editovanje u bazi podataka nije bilo uspjesno, opet ce se na istom mjestu prikazati odgovarajuce obavjestenje sa dopisanom greskom koju vraca funkcija mysql_error(). Treca opcija je delete koja sluzi za brisanje ucenika. Klikom na slicicu podize se modal sa pitanjem za potvrdu akcije, ukoliko je potvrdjeno brisanje, ucenik se brise iz evidencije sto je definisano u fajlu index.php. U zavisnosi od toga da li je brisanje bilo uspjesno, iznad tabele ce se prikazati odgovarajuce obavjestenje.

6. Ispod tabele prikazana je paginacija, rijesena koriscenjem Bootstrapa. Na svakoj stranici, ne nuzno i na zadnjoj, je prikazano po deset ucenika.

7. Na kraju je badge element Bootstrapa koji prikazuje ukupan broj ucenika u evidenciji.

8. Na samom dnu stranice se nalazi footer.

---------------------------------------------------------------------------------------------------------------------------

Druga stranica je Skole, odgovarajuci kod je smjesten u fajl skole.php. Fajl je organizovan na identican nacin kao i prethodni, uz nekoliko razlika:

1. Za pretragu se opet koristi AJAX tehnologija, a AJAX funkcija pristupa fajlu search_skole.php. Procedura je ista kao kod pretrage ucnenika. 

2. Unos nove skole se ne obavlja na isti nacin kao kod ucenika. Kod za unos nove skole u bazu podataka je u ovom fajlu skole.php, a AJAX poziv upotrijebljen za validaciju polja JIB. Uneseni broj se prosljedjuje AJAX funkcijom fajlu validate_input.php. Zahtjev je da JIB broj ima tacno osam cifara i da ga vec nema u evidenciji. U skladu sa rezultatom validacije odziv na AJAX poziv je niz u JSON formatu, koji vraca podesavanja za polje gdje se unosi JIB broj i za dugme 'Save changes'. Ukoliko je validacija neuspijesna polje ce biti uokvireno crvenom linijom, na kraju polja ce se prikazivati znak x i ispod polja odgovarajuca poruka zasto JIB nije ispravan, a dugme 'Save changes' ce biti disejblovano. U slucaju uspjesne validacije, polje za unos ce biti uokvireno zelenom bojom, na kraju ce biti prikazan znak 'tacno', a ispod odgovarajuca poruka. Dugme 'Save changes' ce biti enejblovano. Ukoliko je skola uspjesno unesena iznad tebele ce biti prikazano obavjestenje. Ukoliko upis u bazu nije uspjesan bice prikazano obavjestenje uz tekst greske do koje je doslo. 

3. I ovde kao kod ucenika za svaku skolu postoje opcije details, edit i delete. Opcije edit i delete su rjesene na isti nacin kao za ucenike (podizanje odgovarajucih modala, kod za izvrsavanje operacija se nalazi u ovom istom fajlu skole.php, u zavisnosti od uspjesnosti akcija prikazuju se odgovarajuca obavjestenja iznad tabele). Ono sto je razlicito u odnosu na ucenike je opcija details. Klikom na opciju details, GET metodom se prosljedjuje ID skole, i korisnik je poslat na fajl details_skole.php. Na odgovarajucoj stranici prikazani su detalji izabrane skole u formi tabele. Ispod tabele se nalazi dugme. Klikom na ovo dugme treba da se na stranicu ucitaju svi ucenici koji pohadjaju tu skolu. Ovo je rjeseno koriscenjem AJAX tehnologije. Fajl kom se obraca AJAX poziv je read_students.php. U tom fajlu selektuju se svi ucenici trazene skole i unose se u tabelu sadrzanu u fajlu students_table.php koja se vraca kao odziv na AJAX poziv u tekstualnoj, odnosno html formi. Ukoliko u trazenoj skoli nema ucenika, vraca se kod sa obavjestenjem da nema ucenika. Ukoliko ucenika ima i prikazuju se na stranici, prikazuju se opet sa svojim opijama details, edit i delete. Promjene inicirane klikom na ove opcije se obavljaju u ovom fajlu details_skole.php, pri cemu se forme odgovarajucih modala sabmituju upravo u ovaj fajl details_skole.php. Nakon izvrsavanja ovih opcija, ispod tabele sa podacima skole se prikazuje odgovarajuce obavjestenje. 

--------------------------------------------------------------------------------------------------------------------------

Treca stranica je statistika ciji je odgovarajuci kod u fajlu statistika.php. Na ovoj stranici se prikazuje starosna struktura ucenika po skolama. Razlika u odnosu na prethodna dva fajla je u sljedecem:

1. Za prikaz starosne strukture ucenika koristi se panel element Bootstrapa. Kod za ovaj panel je smjesten u fajlu panel.php. Svaki zaseban panel se sastoji od naslova, progress barova koji prikazuju procente ucenika mladjih od 20 godina, ucenika sa godinama izmedju 20 i 25 godina i ucenika starijih od 25 godina. Ispod ovih barova nalazi se uokvirena lista sa brojem ucenika po kategorijama, gdje su brojevi prikazani koriscenjem badge elementa Bootstrapa. Na dnu panela je progress bar koji prikazuje sve procente u istoj liniji. U samom fajlu statistika.php selektuje se i prikazuje samo 4 prve skole.

2. Ucitavanje vise skola moze se obaviti klikom na dugme 'Ucitaj jos'. Klik inicira AJAX poziv na fajl loading_schools.php. Sa svakim novim klikom u fajlu loading_schools.php se selekuju nove cetiri skole, podaci za skole se smjestaju u prethodno pomenute panele, vracaju se AJAX funkcijom i prikazuju na stranici. Ukoliko se dodje do kraja (ucitaju se sve skole), vraca se poruka 'error', na osnovu koje se prikazuje obavjestenje da nema vise skola i disejbluje se dugme za ucitavanje. 

--------------------------------------------------------------------------------------------------------------------------

