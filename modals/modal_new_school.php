<!-- MODAL ZA UNOS NOVE SKOLE -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nova skola</h4>
            </div>
            <div class="modal-body">
                <form id="form-new-school" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                    <div class="form-group">
                        <input class="form-control" type="text" id="name" name="name" value="" placeholder="Upisite naziv skole">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="jib"  name="jib" value="" placeholder="Upisite JIB skole">
                        <span class="glyphicon form-control-feedback" id = "add-class"></span>
                        <label class="control-label" id="jib-label" style="display: none;"></label>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="address" name="address" value="" placeholder="Upisite adresu skole">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" id="phone" name="phone" value="" placeholder="Upisite broj telefona skole">
                    </div>
                    <input type="hidden" name="modal_new" id="modal_new" value="new_school">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-submit" data-formid="form-new-school">Save changes</button>
            </div>
        </div>
    </div>
</div>

