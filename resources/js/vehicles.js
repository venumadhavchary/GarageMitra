import { handleRequest } from './api.js';


 
const addVehicleForm = document.getElementById("add_vehicle_form");
const editVehicleForm = document.getElementById("edit_vehicle_form");
const addVehicleButton = document.getElementById("add_vehicle_button");
const updateVehicleButton = document.getElementById("update_vehicle_button");
const editVehicleButtons = document.querySelectorAll(".edit-vehicle-btn");

// Add Vehicle Form Submission
if (addVehicleButton && addVehicleForm) {
    addVehicleButton.addEventListener("click", async function (event) {
        event.preventDefault();
        
        // Show loading state
        addVehicleButton.disabled = true;
        addVehicleButton.innerHTML = '⏳ Saving...';
        
        try {
            await handleRequest(event, addVehicleForm, appRoutes.addVehicle);
        } finally {
            addVehicleButton.disabled = false;
            addVehicleButton.innerHTML = 'Save Vehicle';
        }
    });
}

// Update Vehicle Form Submission
if (updateVehicleButton && editVehicleForm) {
    updateVehicleButton.addEventListener("click", async function (event) {
        event.preventDefault();
        
        const successText = editVehicleForm.querySelector('.alert-success');
        if (successText) {
            successText.style.display = "block";
            successText.innerHTML = "⏳ Updating...";
        }
        
        // Show loading state
        updateVehicleButton.disabled = true;
        updateVehicleButton.innerHTML = '⏳ Updating...';
        
        try {
            const vehicleId = editVehicleForm.dataset.vehicleId;
            const url = appRoutes.updateVehicle.replace("VEHICLE_ID", vehicleId);
            await handleRequest(event, editVehicleForm, url, true);
        } finally {
            updateVehicleButton.disabled = false;
            updateVehicleButton.innerHTML = 'Update Vehicle';
        }
    });
}

// Edit Vehicle Button Click - Populate Form and Open Modal
if (editVehicleButtons.length > 0 && editVehicleForm) {
    editVehicleButtons.forEach(button => {
        button.addEventListener("click", function(e) {
            const vehicleData = e.currentTarget.dataset.vehicle;
            if (!vehicleData) return;
            
            const vehicle = JSON.parse(vehicleData);
            
            // Store vehicle ID for update
            editVehicleForm.dataset.vehicleId = vehicle.id;
            
            // Fields to populate
            const columns = [
                "vehicle_number",
                "make",
                "model",
                "fuel_type",
                "vehicle_type",
                "owner_name",
                "owner_contact",
                "secondary_contact",
                "owner_email",
                "address"
            ];
            
            // Populate each field
            columns.forEach(column => {
                const inputField = editVehicleForm.querySelector(`[name="${column}"]`);
                if (inputField) {
                    inputField.value = vehicle[column] ?? '';
                }
            });
            
            // Handle vehicle image preview
            const currentImage = editVehicleForm.querySelector("#current_vehicle_image");
            const imageUrl = e.currentTarget.dataset.vehicle_image;
            if (currentImage) {
                if (imageUrl && imageUrl !== 'undefined' && !imageUrl.endsWith('/')) {
                    currentImage.src = imageUrl;
                    currentImage.style.display = "block";
                } else {
                    currentImage.style.display = "none";
                }
            }
            
            // Clear any previous alerts
            const alerts = editVehicleForm.querySelectorAll('.alert');
            alerts.forEach(alert => alert.style.display = 'none');
            
            // Open the modal
            openModal('edit_vehicle');
        });
    });
}
