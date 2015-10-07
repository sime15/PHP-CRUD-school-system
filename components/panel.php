<?php

/* FAJL KOJI SLUZI ZA PRIKAZ STAROSNE STRUKTURE UCENIKA PO SKOLAMA, U FORMI PANELA SA LISTOM I PROGRESS BAROVIMA;
OVAJ PANEL SE KORISTI ZA PRIKAZ STATISTIKE SVAKE SKOLE U FAJLU statistika.php, KAO I U HTML KODU KOJI SE VRACA
NAKON AJAX POZIVA INICIRANOG RADI UCITAVANJA VISE SKOLA NA STRANICU */

/* 1 - selektovanje svih ucenika i ucenika po godinama, racunanje odgovarajucih proceanata */
$sqlStudents = "SELECT * FROM ucenici WHERE ucenici.skola_id = ".$school["skola_id"];
$query = mysql_query($sqlStudents);
$allStudents = mysql_num_rows($query);

$sqlYoung = $sqlStudents. " AND ucenici.ucenik_godine < 20";
$queryYoung = mysql_query($sqlYoung);
$young = mysql_num_rows($queryYoung);
$youngPercent = round((100 * $young)/$allStudents,2);

$sqlMid = $sqlStudents. " AND ucenici.ucenik_godine >= 20 AND ucenici.ucenik_godine < 25";
$queryMid = mysql_query($sqlMid);
$mid = mysql_num_rows($queryMid);
$midPercent = round((100 * $mid)/$allStudents,2);

$sqlOld = $sqlStudents. " AND ucenici.ucenik_godine >= 25";
$queryOld = mysql_query($sqlOld);
$old = mysql_num_rows($queryOld);
$oldPercent = round((100 * $old)/$allStudents,2);

?>

<!-- 2 - panel element bootstrapa-->
<div class="panel panel-primary">
    <div class="panel-heading"><?=$school["skola_naziv"]?></div>
    <div class="panel-body">

        <!-- 3 - progress-bar elementi bootstrapa koji prikazuju procente ucenika po godinama-->
        <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$youngPercent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$youngPercent?>%">
                <span><?=$youngPercent?>%</span>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?=$midPercent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$midPercent?>%">
                <span><?=$midPercent?>%</span>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$oldPercent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$oldPercent?>%">
                <span><?=$oldPercent?>%</span>
            </div>
        </div>

        <!-- 4 - prikaz broja ucenika po godinama, u listi, uz pomoc badge elementa bootstrapa -->
        <h4>Starosna struktura ucenika</h4>
        <ul class="list-group border">
            <li class="list-group-item">
                <span class="badge"><?=$young?></span>
                Manje od 20 godina.
            </li>
            <li class="list-group-item">
                <span class="badge"><?=$mid?></span>
                Izmedju 20 i 25 godina.
            </li>
            <li class="list-group-item">
                <span class="badge"><?=$old?></span>
                Preko 25 godina.
            </li>
        </ul>

        <!-- 5 - progress-bar sa procentima u jednoj liniji-->
        <div class="progress">
            <div class="progress-bar progress-bar-success" style="width: <?=$youngPercent?>%">
                <span><?=$youngPercent?>%</span>
            </div>
            <div class="progress-bar progress-bar-warning" style="width: <?=$midPercent?>%">
                <span><?=$midPercent?>%</span>
            </div>
            <div class="progress-bar progress-bar-danger" style="width: <?=$oldPercent?>%">
                <span><?=$oldPercent?>%</span>
            </div>
        </div>

    </div>

</div>
