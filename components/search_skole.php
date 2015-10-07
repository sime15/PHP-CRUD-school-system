<?php

/* PRETRAGA SKOLA UZ UPOTREBU AJAX TEHNOLOGIJE KOJA OMOGUCAVA PRETRAGU UCENIKA U TOKU UNOSENJA STRINGA ZA PRETRAGU;
NA STRANICI skole.php ISPOD POLJA ZA PRETRAGU SE PRIKAZUJE DROPDOWN MENI SA LINKOVANIM IMENIMA SKOLA KOJE SU PRONADJENE
NA OSNOVU TRENUTNO UKUCANOG STRINGA, A PRIJE SABMITOVANJA KOMPLETNOG STRINGA ZA PRETRAGU */

include "../incl/data.inc.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $search_term = $_POST['search_term'];
    if($search_term != '')
    {
        $sqlQuery = "SELECT * FROM skole WHERE (skole.skola_naziv LIKE '%".$search_term."%')";
        $query = mysql_query($sqlQuery);
        $schools = array();
        while($row = mysql_fetch_assoc($query)) {
            $schools [] = $row;
        }

        header('Content-Type: application/json');
        print json_encode($schools);
    }
    else
    {
        $no_result [] = 'no-results';
        header('Content-Type: application/json');
        print json_encode($no_result);
    }
}
else
{
    header('Content-Type: application/json');
    print 'You do not have permission to access this file!!!';
}