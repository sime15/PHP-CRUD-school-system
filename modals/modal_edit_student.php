<!-- MODAL ZA EDITOVANJE PODATAKA UCENIKA -->

<div class="modal fade" id="editStudentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit ucenik</h4>
            </div>
            <div class="modal-body">
                <form id="form-new-student" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" id="name-edit" name="name" value="" placeholder="Upisite ime ucenika">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="surname-edit" name="surname" value="" placeholder="Upisite prezime ucenika">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="years-edit" name="years" value="" placeholder="Upisite starost ucenika">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="schools-edit" name="schools">
                            <? foreach($schools as $school) : ?>
                                <option value="<?=$school['skola_id'] ?>"><?=$school['skola_naziv']; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="student-id" id="student-id" value="">
                    <input type="hidden" name="modal_edit" id="modal_edit" value="edit_student">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit" data-formid="form-new-student">Save changes</button>
            </div>
        </div>
    </div>
</div>