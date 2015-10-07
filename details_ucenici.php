<?php

/* 1 - ukljucivanje fajlova potrebnih u ovom fajlu */
include "incl/data.inc.php";

/* 2 - prijava gresaka */
error_reporting(0);
ini_set("display_errors", 0);

/* 3 - selektovanje ucenika iz baze prema id-iju*/
$iducenika = $_GET['id'];
$sqlQuery = "SELECT ucenici.*,skole.skola_naziv FROM ucenici,skole WHERE ucenici.ucenik_id = $iducenika AND ucenici.skola_id = skole.skola_id";
$query = mysql_query($sqlQuery);
$row = mysql_fetch_assoc($query);

/* 4 - podesavanje za breadcrumbs */
$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => false,
        'link' => 'index.php'
    ),
    array(
        'title' => 'Podaci ucenika',
        'active' => true,
        'link' => 'details_ucenici.php'
    ),
);

?>

<!DOCTYPE HTML>
<html>

<head>

    <!-- 5 - naslov stranice i ucitavanje potrebnih skipti -->
    <title>Podaci ucenika</title>
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici/assets/css/bootstrap.css">

</head>

<body>

<!-- 6 - organizovanje i pozicioniranje fajla i elemenata-->
<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">

    <div class = "row">

        <div class = "col-md-3"></div>

        <div class = "col-md-6">

            <!-- 7 - blockquote element bootstrap-a-->
            <blockquote class="blockquote-reverse">
                Ministarstvo prosvete
            </blockquote>

            <!-- 8 - ukljcivanje breadcrumbsa-->
            <? include("components/breadcrumbs.php") ?>

            <!-- 9 - tabela za prikaz podataka ucenika -->
            <table class = "table table-bordered" style="border-width: 2px ">
                <th colspan="2" class="text-center">PODACI UCENIKA</th>
                <tr>
                    <td>Ime ucenika:</td>
                    <td><?=$row['ucenik_ime']; ?></td>
                </tr>
                <tr>
                    <td>Prezime ucenika:</td>
                    <td><?=$row['ucenik_prezime']; ?></td>
                </tr>
                <tr>
                    <td>Godine ucenika:</td>
                    <td><?=$row['ucenik_godine']; ?></td>
                </tr>
                <tr>
                    <td>Skola:</td>
                    <td><?=$row['skola_naziv'] ?></td>
                </tr>

            </table>
            <hr>

            <!-- 10 - futer-->
            <footer>
                <p>&copy; <?php echo date('Y') ?> Vlada Republike Nedodjije</p>
            </footer>

        </div>

        <div class = "col-md-3"></div>

    </div>

</div>

</body>

</html>
