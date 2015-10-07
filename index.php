<?php

/* 1 - ukljucujemo fajlove potrebne u ovom fajlu*/
include "incl/data.inc.php";
include_once("libraries/bootstrap_pagination/pagination.php");
include_once("libraries/AlertObject.php");

/* 2 - prijava gresaka*/
error_reporting(1);
ini_set("display_errors", 1);

/* 3 - pocetno stanje za alert*/
$alert = new AlertObject();

/* 4 - podesavanja modala i odgovarajucih alerta*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    /* 5 - modal i alert za editovanje ucenika*/
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
            $alert->setSuccessAlert("Uspjesno ste editovali podatke ucenika.");
        } else{
            $greska = mysql_error();
            $alert->setWarningAlert("Desila se greska prilikom editovanja podataka ucenika. ".$greska);
        }
    }

    /* 6 - modal i alert za brisanje ucenika*/
    if(isset($_POST['modal_delete']) && $_POST['modal_delete'] == 'delete_student')
    {
        $iddelete = $_POST["id-delete"];

        $brisanje = "DELETE FROM ucenici WHERE ucenik_id = $iddelete";
        mysql_query($brisanje);

        $deleted = mysql_affected_rows();

        if($deleted>0){
            $alert->setSuccessAlert("Uspjesno ste izbrisali ucenika iz evidencije.");
        } else{
            $greska = mysql_error();
            $alert->setWarningAlert("Desila se greska, ucenik nije izbrisan. ".$greska);
        }
    }
}

/* 7 - pretraga, paginacija i selektovanje ucenika*/
$and_clause = '';
$default_url = 'index.php';
$pagination_url = 'index.php?p=[p]';
$search_term = '';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['search'])){
        $and_clause = " AND (ucenici.ucenik_ime LIKE '%".$_GET['search']."%' OR ucenici.ucenik_prezime LIKE '%".$_GET['search']."%')";
        $default_url = 'index.php?search='.$_GET['search'];
        $pagination_url = 'index.php?search='.$_GET['search'].'&p=[p]';
        $search_term = $_GET['search'];
    }
}

$pageSize = 10;

if(isset($_GET['p']))
    $pageNumber = $_GET['p'];
else
    $pageNumber = 1;

$limitPage = ((int)$pageNumber - 1) * $pageSize;

$limit_clause = " LIMIT ".$limitPage.",".$pageSize;

$sqlQuery = "SELECT ucenici.*,skole.skola_naziv FROM ucenici, skole WHERE ucenici.skola_id = skole.skola_id";
$sqlQuery .= $and_clause . $limit_clause;
$query = mysql_query($sqlQuery);

$sqlQueryTotal = "SELECT ucenici.*,skole.skola_naziv FROM ucenici, skole WHERE ucenici.skola_id = skole.skola_id";
$sqlQueryTotal .= $and_clause;
$totalRecords = mysql_num_rows(mysql_query($sqlQueryTotal));


while($row = mysql_fetch_assoc($query)) {
    $students [] = $row;
}

/* 8 - podesavanje paginacije */
$pg = new bootPagination();
$pg->pagenumber = $pageNumber;
$pg->pagesize = $pageSize;
$pg->totalrecords = $totalRecords;
$pg->showfirst = true;
$pg->showlast = true;
$pg->paginationcss = "pagination-large";
$pg->paginationstyle = 1; // 1: advance, 0: normal
$pg->defaultUrl = $default_url;
$pg->paginationUrl = $pagination_url;

/* 9 - selektovanje skola za modal modal_edit_student*/
$sqlSkole = 'SELECT * FROM skole';
$query = mysql_query($sqlSkole);
while($row = mysql_fetch_assoc($query)) {
    $schools [] = $row;
}

/* 10 - podesavanje za main_menu */
$active_menu_item = 'ucenici';

/* 11 - podesavanje za breadcrumbs */
$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => true,
        'link' => 'index.php'
    ),
);

?>

<!DOCTYPE html>
<html>
<head>

    <!-- 12 - naslov stranice i ukljucivanje skripti koje se koriste u fajlu-->
    <title>Ucenici</title>
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici/assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/myScr.js"></script>

</head>

<body>

<!-- 13 - ukljucivanje modala-->
<? include("modals/modal_new_student.php"); ?>

<? include("modals/modal_edit_student.php"); ?>

<? include("modals/modal_delete_student.php"); ?>

<!-- 14 - organizovanje fajla koriscenjem bootstrap grid sistema-->
<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">

    <div class="row">

        <div class="col-md-2"></div>

        <div class="col-md-8">

            <!-- 15 - blockquote element bootstrapa-->
            <blockquote class="blockquote-reverse">
               Ministarstvo prosvete
            </blockquote>

            <!-- 16 - ukljucivanje menija, alerta i breadcrumbsa-->
            <? include("components/main_menu.php"); ?>

            <? include("components/breadcrumbs.php") ?>

            <? include("components/alert.php"); ?>

            <!-- 17 - button za podizanje modala modal_new_student-->
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href="#myModal">Novi ucenik</button>

            <h2>Spisak ucenika</h2>

            <!-- 18 - kreiranje tabele sa ucenicima-->
            <table class="table table-bordered">
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Godine</th>
                    <th>Naziv skole</th>
                    <th>Opcije</th>
                </tr>
                <? foreach($students as $student) : ?>
                    <tr>
                        <td><?=$student['ucenik_ime'] ?></td>
                        <td><?=$student['ucenik_prezime'] ?></td>
                        <td><?=$student['ucenik_godine'] ?></td>
                        <td><?=$student['skola_naziv'] ?></td>
                        <td><a href="http://jpdesign.ba/sime_test/ucenici/details_ucenici.php?id=<?=$student['ucenik_id']?>"><img src="assets/img/details.png"></a>&nbsp<a href="" class="btn-edit-student" data-id="<?=$student['ucenik_id'] ?>" data-name="<?=$student['ucenik_ime'] ?>" data-surname="<?=$student['ucenik_prezime'] ?>" data-years="<?=$student['ucenik_godine'] ?>" data-school="<?=$student['skola_id'] ?>"><img src="assets/img/edit.png"></a>&nbsp<a href="" class="btn-delete-student" data-id="<?=$student['ucenik_id'] ?>"><img src="assets/img/delete.png"></a></td>
                    </tr>
                <? endforeach; ?>
            </table>

            <!-- 19 - prikaz paginacije i broja zapisa u tabeli-->
            <div class="row">
                <div class="col-md-8"><? echo  $pg->process(); ?></div>
                <div class="col-md-4">
                    <div class="pagination pagination-large pull-right">
                        <ul class="list-group">
                            <li class="list-group-item active">
                                Ukupno:
                                <span class="badge">&nbsp;<?=$pg->totalrecords ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr>

            <!-- 20 - futer-->
            <footer>
                <p>&copy; <?php echo date('Y') ?> Vlada Republike Nedodjije</p>
            </footer>

        </div>

        <div class="col-md-2"></div>

    </div>

</div>

</body>

</html>

