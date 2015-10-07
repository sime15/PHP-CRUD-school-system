
<!-- TABELA U KOJU SE UCITAVAJU UCENICI A KOJA SE UKLJUCUJE U FAJL read_students.php -->

<table class="table table-bordered">
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Godine</th>
        <th>Opcije</th>
    </tr>
    <? foreach($students as $student) : ?>
        <tr>
            <td><?=$student['ucenik_ime'] ?></td>
            <td><?=$student['ucenik_prezime'] ?></td>
            <td><?=$student['ucenik_godine'] ?></td>
            <!-- u polju opcije prosljedjuju se atributi i varijable potrebni za funkcionisanje opcija -->
            <td><a href="http://jpdesign.ba/sime_test/ucenici/details_ucenici.php?id=<?=$student['ucenik_id']?>"><img src="http://jpdesign.ba/sime_test/ucenici/assets/img/details.png"></a>&nbsp<a href="" class="btn-edit-student" data-id="<?=$student['ucenik_id'] ?>" data-name="<?=$student['ucenik_ime'] ?>" data-surname="<?=$student['ucenik_prezime'] ?>" data-years="<?=$student['ucenik_godine'] ?>" data-school="<?=$student['skola_id'] ?>"><img src="http://jpdesign.ba/sime_test/ucenici/assets/img/edit.png"></a>&nbsp<a href="" class="btn-delete-student" data-id="<?=$student['ucenik_id'] ?>" data-schooldelete="<?=$student['skola_id'] ?>"><img src="http://jpdesign.ba/sime_test/ucenici/assets/img/delete.png"></a></td>
        </tr>
    <? endforeach; ?>
</table>