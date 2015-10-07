
<?php

/* FAJL KOJI SLUZI ZA UCITAVANJE SKOLA NA STRANICI statistika.php KORISCENJEM AJAX TEHNOLOGIJE*/

/* 1 - povezivanje sa bazom i prijava gresaka */
include '../incl/data.inc.php';

error_reporting(0);
ini_set("display_errors",0);

/* 2 - selektovanje cetiri po cetiri skole sa svakim ajax pozivom */
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $beginFrom = $_POST["add"];
    $sqlSchool = "SELECT skole.skola_id,skole.skola_naziv FROM skole LIMIT ".$beginFrom.", 4";
    $result = mysql_query($sqlSchool);
    while($row = mysql_fetch_assoc($result)){
        $schools [] = $row;
    }
}

/* 3 - prolazak kroz niz schools i smjestanje skola u panele */
if($schools):

    foreach($schools as $school):?>
    <div class = "col-md-6">
        <? include("panel.php"); ?>
    </div>
    <? endforeach;

/* 4 - ako nema vise skola vraca se poruka error, dodata funkcija header() da se ne bi vracali i ovi komentari*/
header("Content-Type:text/plain");
else: echo "error";
endif; ?>







