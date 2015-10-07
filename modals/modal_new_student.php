<!-- MODAL ZA UNOS NOVOG UCENIKA -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novi ucenik</h4>
            </div>
            <div class="alert alert-dismissible unos-ucenika" role="alert" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <form id="form-edit-student" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" id="name" name="name" value="" placeholder="Upisite ime ucenika">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="surname" name="surname" value="" placeholder="Upisite prezime ucenika">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="years" name="years" value="" placeholder="Upisite staros ucenika">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="schools" name="schools">
                            <? foreach($schools as $school) : ?>
                                <option value="<?=$school['skola_id'] ?>"><?=$school['skola_naziv']; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" name="modal_new" id="modal_new" value="new_student">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit-new" data-formid="form-edit-student">Save changes</button>
            </div>
        </div>
    </div>
</div>