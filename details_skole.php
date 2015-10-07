<?php

/* 1 - ukljucivanje fajlova potrebnih u ovom fajlu */
include "incl/data.inc.php";
include_once("libraries/AlertObject.php");

/* 2 - prijava gresaka */
error_reporting(1);
ini_set("display_errors", 1);

/* 3 - pocetno stanje za alert*/
$alert = new AlertObject();

/* 4 - selektovanje skola iz baze prema id-iju*/
$idskole = $_GET['id'];
$sqlQuery = "SELECT skole.* FROM skole WHERE skole.skola_id = $idskole";
$query = mysql_query($sqlQuery);
$row = mysql_fetch_assoc($query);

/* 5 - podesavanje za breadcrumbs */
$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => false,
        'link' => 'index.php'
    ),
    array(
        'title' => 'Skole',
        'active' => false,
        'link' => 'skole.php'
    ),
    array(
        'title' => 'Podaci o skoli',
        'active' => true,
        'link' => 'details_skole.php'
    ),
);

/* 6 - selektovanje skola za modal modal_edit_student */
$sqlSkole = 'SELECT * FROM skole';
$query = mysql_query($sqlSkole);
while($rowSchools = mysql_fetch_assoc($query)) {
    $schools [] = $rowSchools;
}

/* 7 - modal i alert za editovanje ucenika */
if(isset($_POST['modal_edit']) && $_POST['modal_edit'] == 'edit_student')
{
    $editime = $_POST["name"];
    $editprezime = $_POST["surname"];
    $editgodine = $_POST["years"];
    $editskola = $_POST["schools"];
    $id = $_POST["student-id"];

    $editovano = "UPDATE ucenici SET ucenik_ime = '$editime',ucenik_prezime = '$editprezime',ucenik_godine = '$editgodine',skola_id = '$editskola' WHERE ucenik_id = $id";
    mysql_query($editovano);

    $edited = mysql_affected_rows();

    if($edited>0){
        $alert->setSuccessAlert("Uspjesno ste editovali podatke ucenika. Ponovo kliknite 'Ucitaj ucenike' za prikaz.");
    } else{
        $greska = mysql_error();
        $alert->setWarningAlert("Desila se greska prilikom editovanja podataka ucenika. ".$greska);
    }

}

/* 8 - modal i alert za brisanje ucenika*/
if(isset($_POST['modal_delete']) && $_POST['modal_delete'] == 'delete_student')
{
    $iddelete = $_POST["id-delete"];

    $brisanje = "DELETE FROM ucenici WHERE ucenik_id = $iddelete";
    mysql_query($brisanje);

    $deleted = mysql_affected_rows();

    if($deleted>0){
        $alert->setSuccessAlert("Uspjesno ste izbrisali ucenika iz evidencije. Da bi ste vidjeli preostale, kliknite na 'Ucitaj ucenike'");
    } else{
        $greska = mysql_error();
        $alert->setWarningAlert("Desila se greska, ucenik nije izbrisan. ".$greska);
    }
}

?>

<!DOCTYPE HTML>
<html>

<head>

    <!-- 9 - naslov stranice i ukljucivanje skripti koje se koriste u fajlu-->
    <title>Podaci skole</title>
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici/assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/myScr.js"></script>

</head>

<body>

<!-- 10 - ukljucivanje modala-->

<? include("modals/modal_edit_student.php"); ?>

<? include("modals/modal_delete_student.php"); ?>

<!-- 11 - organizovanje i pozicioniranje fajla i elemenata-->
<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">

    <div class = "row">

        <div class = "col-md-3"></div>

        <div class = "col-md-6">

            <!-- 12 - blockquote element bootstrap-a-->
            <blockquote class="blockquote-reverse">
                Ministarstvo prosvete
            </blockquote>

            <!-- 13 - ukljucivanje breadcrumbsa -->
            <? include("components/breadcrumbs.php") ?>

            <!-- 14 - tabela za prikaz podataka skola -->
            <table class = "table table-bordered" style="border-width: 2px ">
                <th colspan="2" class="text-center">PODACI O SKOLI</th>
                <tr>
                    <td>Naziv skole:</td>
                    <td><?=$row['skola_naziv']; ?></td>
                </tr>
                <tr>
                    <td>JIB skole:</td>
                    <td><?=$row['skola_jib']; ?></td>
                </tr>
                <tr>
                    <td>Adresa skole:</td>
                    <td><?=$row['skola_adresa']; ?></td>
                </tr>
                <tr>
                    <td>Broj telefona:</td>
                    <td><?=$row['skola_telefon'] ?></td>
                </tr>

            </table>

            <!-- 15 - ukljucivanje alerta-->
            <? include("components/alert.php"); ?>

            <hr>

            <!-- 16 - dugme za ucitavanje ucenika prikazane skole -->
            <button type="button" class="btn btn-primary" id="btn-read-students" data-id="<?=$row['skola_id']; ?>">Ucitaj ucenike</button>

            <hr>

            <!-- 17 - prikaz loading znaka dok se obavlja ajax poziv-->
            <div class="row">
                <div class="col-md-12 col-md-offset-4" id="loading" style="display: none;"><img src="assets/img/loading_spinner.gif"></div>
            </div>

            <!-- 18 - mjesto na stranici gdje ce se prikazati ucenici pojedinacne skole ucitani uz pomoc ajax tehnologije-->
            <div id="students-table">

            </div>

            <hr>

            <!-- 19 - futer -->
            <footer>
                <p>&copy; <?php echo date('Y') ?> Vlada Republike Nedodjije</p>
            </footer>

        </div>

        <div class = "col-md-3"></div>

    </div>

</div>

</body>

</html>