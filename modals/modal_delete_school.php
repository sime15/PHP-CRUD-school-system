<!-- MODAL ZA BRISANJE SKOLE IZ EVIDENCIJE -->

<div class="modal fade" id="deleteSchoolModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete skola</h4>
            </div>
            <div class="modal-body">
                <form id="form-delete-school" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <label>Da li ste sigurni da zelite obrisati skolu?</label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                        <button type="button" class="btn btn-primary btn-submit" data-formid="form-delete-school">Da</button>
                    </div>
                    <input type="hidden" name="delete-id" id="delete-id" value="">
                    <input type="hidden" name="modal_delete" id="modal_delete" value="delete_school">
                </form>
            </div>
        </div>
    </div>
</div>

