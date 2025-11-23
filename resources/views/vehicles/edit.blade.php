{{-- modal --}}

<div class="modal fade" id="edit_vehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_vehicle_form">
                    @csrf
                    <div id="error_text" class="error-txt">This is a error message</div>
                    <div id="success_text" class="success-txt">This is a success message</div>
                    <div class="form-group img-preview-group">
                        <label for="vehicle_image" class="col-form-label">Vehicle Image:</label>
                        <img src="" alt="Vehicle Image" id="current_vehicle_image" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                        <input type="file" class="form-control" id="vehicle_image" name="vehicle_image" placeholder="change">
                    </div>
                    <div class="form-group">
                        <label for="vehicle_number" class="col-form-label">Vehicle Number:</label>
                        <input type="text" class="form-control" id="vehicle_number" name="vehicle_number">
                    </div>
                    <div class="form-group">
                        <label for="make" class="col-from-label">Make/Company</label>
                        <input type="text" class="form-control" id="make" name="make">
                    </div>
                    <div class="form-group">
                        <label for="model" class="col-from-label">model</label>
                        <input type="text" class="form-control" id="model" name="model">
                    </div>
                    <div class="form-group">
                        <label for="fuel_type" class="col-from-label"></label>
                        <select type="text" class="form-control" id="fuel_type" name="fuel_type">
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="cng">CNG</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="owner_name" class="col-from-label">Vehicle Owner</label>
                        <input type="text" class="form-control" id="owner_name" name="owner_name">
                    </div>
                    <div class="form-group">
                        <label for="owner_contact" class="col-from-label">Owner Number</label>
                        <input type="tel" class="form-control" id="owner_contact" name="owner_contact">
                    </div>
                    <div class="form-group">
                        <label for="secondary_number" class="col-from-label">Secondary Number</label>
                        <input type="tel" class="form-control" id="secondary_number" name="secondary_number">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-from-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-from-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="update_vehicle_button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
