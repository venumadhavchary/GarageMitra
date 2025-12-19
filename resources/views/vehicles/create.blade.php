{{-- modal --}}

<div class="modal-backdrop" id="add_vehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal">
        <div class="modal-header">
            <h5 class="modal-title">Add Vehicle</h5>
            <button class="modal-close" onclick="closeModal('add_vehicle')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="add_vehicle_form">
                @csrf
                <div class="alert alert-success" id="success_text" style="display: none;">
                    ✅ <strong>Success!</strong> Vehicle added successfully.
                </div>

                <div class="alert alert-danger" id="error_text" style="display: none;">
                    ❌ <strong>Error!</strong> Failed to add vehicle.
                </div>
                <div class="form-group">
                    <label for="vehicle_image" class="form-label">Vehicle Image:</label>
                    <input type="file" class="form-control" id="vehicle_image" name="vehicle_image" accept="image/*">
                    <small class="text-danger d-block" id="vehicle_image_error"></small>
                </div>
                <div class="form-group">
                    <label for="vehicle_number" class="form-label required">Vehicle Number:</label>
                    <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" placeholder="e.g., MH12AB1234" required>
                    <small class="text-danger d-block" id="vehicle_number_error"></small>
                </div>
                <div class="d-flex gap-3">
                    <div class="form-group" style="flex: 1;">
                        <label for="make" class="form-label required">Make/Company</label>
                        <input type="text" class="form-control" id="make" name="make" placeholder="e.g., Honda" required>
                        <small class="text-danger d-block" id="make_error"></small>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="model" class="form-label required">Model</label>
                        <input type="text" class="form-control" id="model" name="model" placeholder="e.g., City" required>
                        <small class="text-danger d-block" id="model_error"></small>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <div class="form-group" style="flex: 1;">
                        <label for="fuel_type" class="form-label required">Fuel Type</label>
                        <select class="form-control" id="fuel_type" name="fuel_type" required>
                            <option value="">Select fuel type...</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="cng">CNG</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                        <small class="text-danger d-block" id="fuel_type_error"></small>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="vehicle_type" class="form-label required">Vehicle Type</label>
                        <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                            <option value="">Select type...</option>
                            <option value="car">Car</option>
                            <option value="bike">Bike</option>
                            <option value="truck">Truck</option>
                            <option value="bus">Bus</option>
                            <option value="auto">Auto</option>
                            <option value="other">Other</option>
                        </select>
                        <small class="text-danger d-block" id="vehicle_type_error"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="owner_name" class="form-label required">Vehicle Owner</label>
                    <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Owner full name" required>
                    <small class="text-danger d-block" id="owner_name_error"></small>
                </div>
                <div class="d-flex gap-3">
                    <div class="form-group" style="flex: 1;">
                        <label for="owner_contact" class="form-label required">Owner Number</label>
                        <input type="tel" class="form-control" id="owner_contact" name="owner_contact" placeholder="10-digit number" required>
                        <small class="text-danger d-block" id="owner_contact_error"></small>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="secondary_contact" class="form-label">Secondary Number</label>
                        <input type="tel" class="form-control" id="secondary_contact" name="secondary_contact" placeholder="Optional">
                        <small class="text-danger d-block" id="secondary_contact_error"></small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="owner_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="owner_email" name="owner_email" placeholder="email@example.com">
                    <small class="text-danger d-block" id="owner_email_error"></small>
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="2" placeholder="Full address"></textarea>
                    <small class="text-danger d-block" id="address_error"></small>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" onclick="closeModal('add_vehicle')">Cancel</button>
            <button type="button" class="btn btn-primary" id="add_vehicle_button">Save Vehicle</button>
        </div>
    </div>
</div>
