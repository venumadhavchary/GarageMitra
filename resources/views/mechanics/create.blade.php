{{-- modal --}}

<div class="modal fade" id="add_mechanic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Mechanic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_mechanic_form">
                    @csrf
                    <div id="error_text" class="error-txt">This is a error message</div>
                    <div id="success_text" class="success-txt">This is a success message</div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="specialization" class="col-form-label">Specialization:</label>
                        <input type="text" class="form-control" id="specialization" name="specialization">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Phone Number:</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add_mechanic_button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
