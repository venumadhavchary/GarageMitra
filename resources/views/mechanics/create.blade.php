{{-- modal --}}

<div class="modal-backdrop" id="add_mechanic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal">
        <div class="modal-header">
            <h5 class="modal-title">Add Mechanic</h5>
                <button class="modal-close" onclick="closeModal('add_mechanic')">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            <div class="modal-body">
                <form id="add_mechanic_form">
                    @csrf
                    <div class="alert alert-success" id="success_text" style="display: none;">
                        ✅ <strong>Success!</strong> Mechanic added successfully.
                    </div>
                    <div class="alert alert-danger" id="error_text" style="display: none;">
                        ❌ <strong>Error!</strong> Failed to add Mechanic.
                    </div>
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
                <button type="button" class="btn btn-secondary" onclick="closeModal('add_mechanic')">Cancel</button>
                <button type="button" id="add_mechanic_button" class="btn btn-primary">Add Mechanic</button>
            </div>
        </div>
    </div>
</div>
