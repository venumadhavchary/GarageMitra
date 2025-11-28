<div class="modal-backdrop" id="edit_jobcard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal">
        <div class="modal-header">
            <h5 class="modal-title">Edit Service details</h5>
            <button class="modal-close" onclick="closeModal('edit_jobcard')">×</button>
        </div>
        <div class="modal-body">
            <form id="edit_jobcard_form">
                @csrf
                <div class="alert alert-success" id="success_text" style="display: none;">
                    ✅ <strong>Success!</strong> Vehicle added successfully.
                </div>

                <div class="alert alert-danger" id="error_text" style="display: none;">
                    ❌ <strong>Error!</strong> Failed to add vehicle.
                </div>
                <h6 class="mb-3"
                    style="color: var(--gray-500); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px;">
                    Vehicle Details
                </h6>
                <input name="id" hidden>
                <div class="d-flex flex-wrap gap-4 mb-4">
                    <!-- Advance Pay -->
                    <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                        <label class="form-label required">Advance Pay</label>
                        <input type="text" class="form-control" name="paid_amount"
                            placeholder="Advance payment amount" >
                        <small class="text-danger d-block"></small>

                    </div>

                    <!-- Odometer -->
                    <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                        <label class="form-label required">Odometer</label>
                        <input type="tel" class="form-control" name="odometer_reading"
                            placeholder="Odometer reading">
                        <small class="text-danger d-block"></small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Fuel Range: <span id="rangeValue"> </span></label>
                    <input type="range" class="form-range" min="0" max="100" name="fuel_level"
                        oninput="document.getElementById('rangeValue').textContent = this.value">
                    <small class="text-danger d-block"></small>
                </div>

                <div class="d-flex flex-wrap gap-4 mb-4">
                    <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                        <label class="form-label required">Vehicle Received From</label>
                        <input class="form-control" type="text" name="vehicle_received_from">
                    </div>
                    <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                        <label class="form-label required">Vehicle Collected By</label>
                        <input class="form-control" type="text" name="vehicle_returned_to">
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-from-label">Remarks</label>
                    <textarea type="text" class="form-control" id="remarks" name="remarks"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal('edit_jobcard')">Close</button>
            <button type="button" id="update_jobcard_button" class="btn btn-primary">Update</button>
        </div>
    </div>
</div>
