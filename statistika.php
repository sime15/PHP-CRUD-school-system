
<?php

/* 1 - ukljuciavanje fajlova potrebnih u ovom fajlu */
include 'incl/data.inc.php';

/* 2 - prijava gresaka */
error_reporting(0);
ini_set("display_errors",0);

/* 3 - selektovanje prve cetiri skole koje se prikazuju */
$sqlSchool = "SELECT skole.skola_id,skole.skola_naziv FROM skole LIMIT 4";
$result = mysql_query($sqlSchool);
while($row = mysql_fetch_assoc($result)){
    $schools [] = $row;
}

/* 4 - podesavanje za main_menu */
$active_menu_item = 'statistika';

/* 5 - podesavanje za breadcrumbs*/
$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => false,
        'link' => 'index.php'
    ),
    array(
        'title' => 'Statistika',
        'active' => true,
        'link' => 'statistika.php'
    ),
);

?>
<!DOCTYPE html>
<html>

<head>

    <!-- 6 - naslov stranice i ukljucivanje skripti koje se koriste u fajlu-->
    <title>Statistika</title>
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici/assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/myScr.js"></script>

</head>

<body>

<!-- 7 - organizovanje fajla koriscenjem bootstrap grid sistema -->
<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">

    <div class = "row">

        <div class = "col-md-2"></div>

        <div class = "col-md-8">

            <!-- 8 - blockquote element bootstrapa -->
            <blockquote class="blockquote-reverse">
                Ministarstvo prosvete
            </blockquote>

            <!-- 9 - ukljucivanje menija i breadcrumbsa -->
            <? include("components/main_menu.php"); ?>

            <? include("components/breadcrumbs.php") ?>

            <h2>Statistika</h2>

            <!-- 10 - prolazak kroz niz koji sadrzi skole, smjestanje skola u odgovarajuci html kod -->
            <div class = "row">
                <? foreach($schools as $school):?>
                    <div class = "col-md-6">

                        <!-- 11 - ukljucivanje fajla koji prikazuje podatke za ucitanu skolu -->
                        <? include("components/panel.php"); ?>
                    </div>
                <? endforeach; ?>
            </div>

            <!-- 12 - mjesto na stranici gdje ce se prikazati skole ucitane uz pomoc ajax tehnologije -->
            <div class="row" id="added-schools">

            </div>

            <!-- 13 - prikaz loading znaka dok se obavlja ajax poziv-->
            <div class="row">
                <div class="col-md-12 col-md-offset-4" id="loading" style="display: none;"><img src="assets/img/loading_spinner.gif"></div>
            </div>

            <!-- 14 - obavjestenje da vise nema skola za ucitavanje-->

            <div class="alert alert-info alert-dismissible" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Nema vise skola u evidenciji.</p>
            </div>

            <!-- 15 - dugme za ucitavanje jos skola-->
            <button type="button" class="btn btn-primary center-block" id="more-schools">Ucitaj jos</button>
            <hr>

            <!-- 16 - futer -->
            <footer>
                <p>&copy; <?php echo date('Y') ?> Vlada Republike Nedodjije</p>
            </footer>

        </div>

        <div class = "col-md-2"></div>

    </div>

</div>

</body>

</html>