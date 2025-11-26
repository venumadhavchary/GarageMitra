import { handleRequest } from './api.js';


const addVehicleForm = document.getElementById("add_vehicle_form");
const editVehicleForm = document.getElementById("edit_vehicle_form");
const addVehicleButton = document.getElementById("add_vehicle_button");
const updateVehicleButton = document.getElementById("update_vehicle_button");
const editVehicleButton = document.getElementById("edit_button");
// console.log(typeof handleRequest);
addVehicleButton.addEventListener("click", async function (event) {
    event.preventDefault();
    const formData = new FormData(addVehicleForm);
    await handleRequest(event, addVehicleForm, appRoutes.addVehicle);
});

updateVehicleButton.addEventListener("click", async function (event) {
    editVehicleForm.querySelector('#success_text').style.display = "block";
    editVehicleForm.querySelector('#success_text').textContent = "Updating..."; 
    event.preventDefault();
    const vehicleId = editVehicleForm.dataset.vehicleId;
    const url = appRoutes.updateVehicle.replace("VEHICLE_ID", vehicleId);
    await handleRequest(event, editVehicleForm, url, true);
});

editVehicleButton.addEventListener("click", function(e) {
    const vehicle = JSON.parse(e.target.dataset.vehicle); 
    
    console.log(vehicle);
    editVehicleForm.dataset.vehicleId = vehicle.id;
    const $columns = [
        "vehicle_number",
        "make",
        "model",
        "fuel_type",
        "owner_name",
        "owner_contact",
        "secondary_number",
        "email",
        "address"
    ];
    
    $columns.forEach(column => {

        const inputField = editVehicleForm.querySelector("#" + column);
        if (inputField) {
            inputField.value = vehicle[column] ?? '';
        }
    });
    const currentImage = editVehicleForm.querySelector("#current_vehicle_image");
    const imageUrl = e.target.dataset.vehicle_image;
    if (imageUrl && imageUrl !== 'undefined') {
        currentImage.src = imageUrl;
        currentImage.style.display = "block";
    } else {
        currentImage.style.display = "none";
    }
});
// $("#edit_vehicle").on("show.bs.modal", function (event) {
//     var button = $(event.relatedTarget);
//     var modal = $(this);

//     const vehicle_number = editVehicleForm.querySelector("#vehicle_number");
//     const make = editVehicleForm.querySelector("#make");
//     const model = editVehicleForm.querySelector("#model");
//     const fuel_type = editVehicleForm.querySelector("#fuel_type");
//     const owner_name = editVehicleForm.querySelector("#owner_name");
//     const owner_contact = editVehicleForm.querySelector("#owner_contact");
//     const secondary_number = editVehicleForm.querySelector("#secondary_number");
//     const email = editVehicleForm.querySelector("#email");
//     const address = editVehicleForm.querySelector("#address"); 

//     editVehicleForm.dataset.vehicleId = button.data("id");
//     vehicle_number.value = button.data("vehicle_number");
//     make.value = button.data("make");
//     model.value = button.data("model");
//     fuel_type.value = button.data("fuel_type");
//     owner_name.value = button.data("owner_name");
//     owner_contact.value = button.data("owner_contact");
//     secondary_number.value = button.data("secondary_number");
//     email.value = button.data("email");
//     address.value = button.data("address");
// });
