{{-- modal --}}

<div class="modal-backdrop" id="add_spare_part" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal">
        <div class="modal-header">
            <h5 class="modal-title">Spare Expected</h5>
            <button class="modal-close" onclick="closeModal('add_spare_part')">×</button>
        </div>
        <div class="modal-body">
            <form id="add_spare_form">
                @csrf
                <div class="alert alert-success" id="success_text" style="display: none;">
                    ✅ <strong>Success!</strong> Spare Part added successfully.
                </div>

                <div class="alert alert-danger" id="error_text" style="display: none;">
                    ❌ <strong>Error!</strong> Failed to add spare part.
                </div>
    
                <div class="form-group">
                    <label for="spare_name" class="form-label required">Spare Name:</label>
                    <input type="text" class="form-control"  name="spare_name" placeholder="Engine Oil ..." required> 
                    <small class="text-danger d-block" id="spare_name_error"></small>
                </div>
                <div class="form-group">
                    <label for="spare_quantity" class="form-label required">Quantity:</label>
                    <input type="text" class="form-control"   name="quantity" placeholder="(0 to 10)" required>
                    <small class="text-danger d-block" id="quantity_error"></small> 
                </div>
                <div class="form-group">
                    <label for="vehicle_number" class="form-label required">Unit Price:</label>
                    <input type="text" class="form-control" name="unit_price" placeholder="100" required> 
                    <small class="text-danger d-block" id="unit_price_error"></small>
                </div>
                 
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" onclick="closeModal('add_spare_part')">Cancel</button>
            <button type="button" class="btn btn-primary" id="add_spare_button">Add</button>
        </div>
    </div>
</div>


{{-- modal --}}

<div class="modal-backdrop" id="add_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal">
        <div class="modal-header">
            <h5 class="modal-title">Service to do</h5>
            <button class="modal-close" onclick="closeModal('add_service')">×</button>
        </div>
        <div class="modal-body">
            <form id="add_service_form">
                @csrf
                <div class="alert alert-success" id="success_text" style="display: none;">
                    ✅ <strong>Success!</strong> Spare Part added successfully.
                </div>

                <div class="alert alert-danger" id="error_text" style="display: none;">
                    ❌ <strong>Error!</strong> Failed to add spare part.
                </div>
    
                <div class="form-group">
                    <label for="service_name" class="form-label required">Name of Service:</label>
                    <input type="text" class="form-control"  name="service_name" placeholder="General Service" required> 
                    <small class="text-danger d-block" id="service_name_error"></small>
                </div>
                <div class="form-group">
                    <label for="price" class="form-label required">Price:</label>
                    <input type="text" class="form-control"   name="price" placeholder="1000" required>
                    <small class="text-danger d-block" id="price_error"></small> 
                </div> 
                 
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" onclick="closeModal('add_service')">Cancel</button>
            <button type="button" class="btn btn-primary" id="add_service_button">Add</button>
        </div>
    </div>
</div>
