<?php

/* 1 - ukljucujemo fajlove potrebne u ovom fajlu */
include 'incl/data.inc.php';
include_once("libraries/bootstrap_pagination/pagination.php");
include_once("libraries/AlertObject.php");

/* 2 - prijava gresaka*/
error_reporting(1);
ini_set("display_errors",1);

/* 3 - pocetno stanje za alert*/
$alert = new AlertObject();

/* 4 - podesavanja modala i odgovarajucih alerta*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    /* 5 - modal i alert za unos nove skole*/
    if(isset($_POST['modal_new']) && $_POST['modal_new'] == 'new_school')
    {
        $select = "SELECT MAX(skole.skola_id) AS id_skole FROM skole";
        $sel = mysql_query($select);
        $row = mysql_fetch_assoc($sel);
        $noviid = $row['id_skole'] + 1;

        $novinaziv = $_POST["name"];
        $novijib = $_POST["jib"];
        $novaadresa = $_POST["address"];
        $novitelefon = $_POST["phone"];
        $upit = "INSERT INTO skole (skola_id,skola_naziv,skola_jib,skola_adresa,skola_telefon) VALUES ('$noviid','$novinaziv','$novijib','$novaadresa','$novitelefon')";
        mysql_query($upit);

        $inserted = mysql_affected_rows();

        if($inserted>0){
            $alert->setSuccessAlert("Uspjesno ste unijeli novu skolu.");
        } else{
            $greska = mysql_error();
            $alert->setErrorAlert("Desila se greska, nova skola nije unesena. ".$greska);
        }
    }

    /* 6 - modal i alert za editovanje skole*/
    if(isset($_POST['modal_edit']) && $_POST['modal_edit'] == 'edit_school')
    {
        $editnaziv = $_POST["name"];
        $editjib = $_POST["jib"];
        $editadresu = $_POST["address"];
        $edittel = $_POST["phone"];
        $idedit = $_POST["id"];

        $editovanje = "UPDATE skole SET skola_naziv = '$editnaziv', skola_jib = '$editjib', skola_adresa = '$editadresu', skola_telefon = '$edittel' WHERE skola_id = '$idedit'";
        mysql_query($editovanje);

        $edited = mysql_affected_rows();

        if($edited>0){
            $alert->setSuccessAlert("Uspjesno ste izmijenili podatke o skoli.");
        } else {
            $greska = mysql_error();
            $alert->setErrorAlert("Desila se greska, podaci o skoli nisu promjenjeni. ".$greska);
        }
    }

    /* 7 - modal i alert za brisanje skole*/
    if(isset($_POST['modal_delete']) && $_POST['modal_delete'] == 'delete_school')
    {
        $iddelete = $_POST["delete-id"];
        $brisanje = "DELETE FROM skole WHERE skola_id = '$iddelete'";
        mysql_query($brisanje);

        $deleted = mysql_affected_rows();

        if($deleted>0){
            $alert->setSuccessAlert("Uspjesno izbrisana skola iz evidencije.");
        }else{
            $greska = mysql_error();
            $alert->setErrorAlert("Desila se greska, skola nije izbrisana. ".$greska);
        }
    }
}

/* 8 - pretraga, paginacija i selektovanje skola */
$where_clause = '';
$default_url = 'skole.php';
$pagination_url = 'skole.php?p=[p]';
$search_term = '';
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['search'])){
        $where_clause = " WHERE (skole.skola_naziv LIKE '%".$_GET['search']."%')";
        $default_url = 'skole.php?search='.$_GET['search'];
        $pagination_url = 'skole.php?search='.$_GET['search'].'&p=[p]';
        $search_term = $_GET['search'];
    }
}

$pageSize = 5;

if(isset($_GET['p'])):
    $pageNumber = $_GET['p'];
else:
    $pageNumber = 1;
endif;

$limitPage = ((int)$pageNumber - 1) * $pageSize;

$limit_clause = " LIMIT ".$limitPage.",".$pageSize;

$sqlQuery = "SELECT * FROM skole";
$sqlQuery .= $where_clause . $limit_clause;
$query = mysql_query($sqlQuery);

$sqlQueryTotal = "SELECT * FROM skole";
$sqlQueryTotal .= $where_clause;
$totalRecords = mysql_num_rows(mysql_query($sqlQueryTotal));

while($row=mysql_fetch_assoc($query)){
    $schools [] = $row;
}

/* 9 - podesavanje paginacije */
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

/* 10 - podesavanje za main_menu*/
$active_menu_item = 'skole';

/* 11 - podesavanje za breadcrumbs*/
$breadcrumbs = array(
    array(
        'title' => 'Home',
        'active' => false,
        'link' => 'index.php'
    ),
    array(
        'title' => 'Skole',
        'active' => true,
        'link' => 'skole.php'
    ),
);

?>

<!DOCTYPE html>
<html>
<head>

    <!-- 12 - naslov stranice i ukljucivanje skripti koje se koriste u fajlu-->
    <title>Skole</title>
    <link rel="stylesheet" href="http://jpdesign.ba/sime_test/ucenici/assets/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/myScr.js"></script>

</head>

<body>

<!-- 13 - ukljucivanje modala-->
<?php include("modals/modal_new_school.php"); ?>

<?php include("modals/modal_edit_school.php"); ?>

<?php include("modals/modal_delete_school.php"); ?>

<!-- 14 - organizovanje fajla koriscenjem bootstrap grid sistema -->
<div style="position: absolute; top: 0;left: 0;bottom: 0;right: 0;margin: auto;">

    <div class="row">

        <div class="col-md-2"></div>

        <div class="col-md-8">

            <!-- 15 - blockquote element bootstrapa-->
            <blockquote class="blockquote-reverse">
                Ministarstvo prosvete
            </blockquote>

            <!-- 16 - ukljucivanje menija, alerta i breadcrumbsa -->
            <? include("components/main_menu.php"); ?>

            <? include("components/breadcrumbs.php"); ?>

            <? include("components/alert.php"); ?>

            <!-- 17 - button za podizanje modala modal_new_school-->
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href="#myModal">Nova skola</button>

            <h2>Spisak skola</h2>

            <!-- 18 - kreiranje tabele sa skolama-->
            <table class="table table-bordered">
                <tr>
                    <th>ID skole</th>
                    <th>Naziv skole</th>
                    <th>JIB skole</th>
                    <th>Adresa skole</th>
                    <th>Telefon</th>
                    <th>Opcije</th>
                </tr>
                <? foreach($schools as $school): ?>
                    <tr>
                        <td><?=$school["skola_id"]?></td>
                        <td><?=$school["skola_naziv"]?></td>
                        <td><?=$school["skola_jib"]?></td>
                        <td><?=$school["skola_adresa"]?></td>
                        <td><?=$school["skola_telefon"]?></td>
                        <td><a href="http://jpdesign.ba/sime_test/ucenici/details_skole.php?id=<?=$school['skola_id']?>"><img src="http://jpdesign.ba/sime_test/ucenici/assets/img/details.png"></a>&nbsp<a href=""  class = "btn-edit-school" data-id = "<?=$school["skola_id"]?>" data-name = "<?=$school["skola_naziv"]?>" data-jib = "<?=$school["skola_jib"]?>" data-address = "<?=$school["skola_adresa"]?>" data-phone = "<?=$school["skola_telefon"]?>"><img src="http://jpdesign.ba/sime_test/ucenici/assets/img/edit.png"></a>&nbsp<a href="" class = "btn-delete-school" data-id = "<?=$school["skola_id"]?>"><img src="http://jpdesign.ba/sime_test/ucenici/assets/img/delete.png"></a></td>
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
