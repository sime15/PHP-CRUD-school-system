<?php

/* FAJL KOJI SLUZI ZA UNOS NOVOG UCENIKA U EVIDENCIJU, KORISCENJEM AJAX TEHNOLOGIJE; UJEDNO I
VALIDACIJA UKOLIKO SU POLJA IME ILI PREZIME OSTAVLJENA PRAZNA; U SLUCAJU NEUSPJESNE VALIDACIJE,
NEUSPJESNOG  ILI USPJESNOG UNOSA, U JSON FORMATU SE VRACAJU PODESAVANJA ZA ODGOVARAJUCE NOTIFIKACIJE*/

/* 1 - ukljucivanje potrebnih fajlova(povezivanje sa bazom)*/
include "../incl/data.inc.php";

/* 2 - prijava gresaka */
error_reporting(1);
ini_set("display_errors", 1);

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    /* 3 - slucaj kada su polja ime ili prezime nepopunjena */
    if($_POST["name"] == '' || $_POST["surname"] == '')
    {
        print json_encode(array('alert-class' => 'alert-warning','alert-message' => 'Ime i prezime moraju biti uneseni.'));
        return;
    }
    else
    {
        /* 4 - unos ucenika u bazu ukoliko su zahtjevana polja popunjena */
        $selektovanje = "SELECT MAX(ucenici.ucenik_id) AS max_id FROM ucenici";
        $sel = mysql_query($selektovanje);
        $row = mysql_fetch_assoc($sel);
        $noviid = $row['max_id'] + 1;

        $novoime = $_POST["name"];
        $novoprezime = $_POST["surname"];
        $novegodine = $_POST["years"];
        $novaskola = $_POST["schools"];
        $upit = "INSERT INTO ucenici (ucenik_id,skola_id,ucenik_ime,ucenik_prezime,ucenik_godine) VALUES ('$noviid','$novaskola','$novoime','$novoprezime','$novegodine')";
        mysql_query($upit);

        $inserted= mysql_affected_rows();

        if($inserted>0){
            print json_encode(array('alert-class' => 'alert-success','alert-message' => 'Uspjesno ste unijeli novog ucenika.'));
            return;
        }
        /* 5 - slucaj kada je unos u bazu neuspjesan */
        else{
            $greska = mysql_error();
            print json_encode(array('alert-class' => 'alert-error','alert-message' => 'Desila se greska prilikom unosa ucenika.'.$greska));
            return;
        }
    }
}
