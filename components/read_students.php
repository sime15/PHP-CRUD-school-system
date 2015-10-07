<?php

/* FAJL U KOM SE SELEKTUJU SVI UCENICI POJEDINACNE SKOLE I U FORMI TABELE, A KORISCENJEM AJAX TEHNOLOGIJE, PRIKAZUJU
SE NA STRANICI TE SKOLE, PRI CEMU SE PRIKAZUJE ODGOVARAJUCA NOTIFIKACIJA AKO U TOJ SKOLI NEMA UCENIKA */

/* 1 - ukljucivanje potrebnih fajlova */
include "../incl/data.inc.php";
include_once("../libraries/AlertObject.php");

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    /* 2 - selektovanje ucenika prema id-iju skole */
    $skola_id = $_POST['skola_id'];

    $sqlQuery = "SELECT * FROM `ucenici` WHERE ucenici.skola_id = ".$skola_id;

    $query = mysql_query($sqlQuery);

    $students = array();
    while($row = mysql_fetch_assoc($query)) {
        $students [] = $row;
    }

    /* 3 - upisivanje ucenika u tabelu iz fajla students_table.php */
    if(!empty($students))
    {
        include("students_table.php");
    }
    /* 4 - ako nema ucenika vraca se odgovarajuca notifikacija */
    else
    {
        $alert = new AlertObject();
        $alert->setInfoAlert("U ovoj skoli nema ucenika.");
        include("../components/alert.php");
    }
    /* 5 - sa servera se vraca tekstualni tip podataka, ovde je to u oba slucaja html kod */
    exit();
}