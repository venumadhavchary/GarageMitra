import { handleRequest } from "./api.js";

document.addEventListener('DOMContentLoaded', function () {
    // Services: show/hide and toggle required/disabled
    const otherServiceCheckbox = document.getElementById('other_service');
    const otherServiceWrapper  = document.getElementById('other_service_input');
    const otherServiceText     = document.getElementById('other_service_text');

    if (otherServiceCheckbox && otherServiceWrapper && otherServiceText) {
        function setOtherService(show) {
            otherServiceWrapper.style.display = show ? 'block' : 'none';
            otherServiceText.disabled = !show;
            otherServiceText.required = show;
        }
        setOtherService(false);
        otherServiceCheckbox.addEventListener('change', function () {
            setOtherService(this.checked);
        });
    }

    // Vehicle Received From: radios
    const recOwnerRadio = document.getElementById('vehicle_received_from_owner');
    const recOtherRadio = document.getElementById('vehicle_received_from_other');
    const recInputWrap  = document.getElementById('vehicle_received_from_input');
    const recInputText  = document.getElementById('vehicle_received_from_text');

    if (recOwnerRadio && recOtherRadio && recInputWrap && recInputText) {
        function showRecInput(show) {
            recInputWrap.style.display = show ? 'block' : 'none';
            recInputText.disabled = !show;
            recInputText.required = show;
        }
        showRecInput(false);
        recOtherRadio.addEventListener('change', () => showRecInput(recOtherRadio.checked));
        recOwnerRadio.addEventListener('change', () => { if (recOwnerRadio.checked) showRecInput(false); });
    }

    // Vehicle Collected By: radios
    const colOwnerRadio = document.getElementById('vehicle_collected_by_owner');
    const colOtherRadio = document.getElementById('vehicle_collected_by_other');
    const colInputWrap  = document.getElementById('vehicle_collected_by_input');
    const colInputText  = document.getElementById('vehicle_collected_by_text');

    if (colOwnerRadio && colOtherRadio && colInputWrap && colInputText) {
        function showColInput(show) {
            colInputWrap.style.display = show ? 'block' : 'none';
            colInputText.disabled = !show;
            colInputText.required = show;
        }
        showColInput(false);
        colOtherRadio.addEventListener('change', () => showColInput(colOtherRadio.checked));
        colOwnerRadio.addEventListener('change', () => { if (colOwnerRadio.checked) showColInput(false); });
    }
});


const imageInput = document.getElementById('multiImageInput');
const uploadWrapper = document.getElementById('imageUploadWrapper');
const uploadBox = document.getElementById('imageUploadBox');
let selectedFiles = [];

imageInput.addEventListener('change', function(e) {
    const files = Array.from(e.target.files);
    
    files.forEach(file => {
        if (file.type.startsWith('image/')) {
            selectedFiles.push(file);
            const index = selectedFiles.length - 1;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-preview-item';
                div.dataset.index = index;
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeImage(${index})">×</button>
                `;
                // Insert before the + button
                uploadWrapper.insertBefore(div, uploadBox);
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Clear input for re-selection
    imageInput.value = '';
});

function removeImage(index) {
    selectedFiles[index] = null;
    const item = document.querySelector(`.image-preview-item[data-index="${index}"]`);
    if (item) item.remove();
}


document.getElementById("old_job").addEventListener("change", function () {
    const jobcardNumberInput = document.getElementById("assigned_date");
    if (this.checked) {
        jobcardNumberInput.removeAttribute("readonly"); 
    } else {
        jobcardNumberInput.setAttribute("readonly", "readonly"); 
    }
});

document.getElementById("other_service").addEventListener("change", function () {
    const inputBox = document.getElementById("other_service_input");

    if (this.checked) {
        inputBox.style.display = "block";
    } else {
        inputBox.style.display = "none";
    }
});
document.getElementById("vehicle_recieved_from_other").addEventListener("change", function () {
    const inputBox = document.getElementById("vehicle_recieved_from_input");

    if (this.checked) {
        inputBox.style.display = "block";
    } else {
        inputBox.style.display = "none";
    }
});
document.getElementById("vehicle_received_from_owner").addEventListener("change", function () {
    document.getElementById("vehicle_recieved_from_input").style.display = "none";
});
document.getElementById("vehicle_collected_by_other").addEventListener("change", function () {
    const inputBox = document.getElementById("vehicle_collected_by_input");

    if (this.checked) {
        inputBox.style.display = "block";
    } else {
        inputBox.style.display = "none";
    }
});
document.getElementById("vehicle_collected_by_owner").addEventListener("change", function () {
    document.getElementById("vehicle_collected_by_input").style.display = "none";
});

const addJobcardForm = document.getElementById("add_jobcard_form");
const editJobcardForm = document.getElementById("edit_jobcard_form");
const addJobcardButton = document.getElementById("add_jobcard_button");
const updateJobcardButton = document.getElementById("update_jobcard_button");
const showAddJobcardButton = document.getElementById("add_jobcard");
const editJobcardButton = document.getElementById("edit_button");
// console.log(typeof handleRequest);
addJobcardButton.addEventListener("click", async function (event) {
    event.preventDefault();
    const formData = new FormData(addJobcardForm);
    await handleRequest(event, addJobcardForm, appRoutes.addJobcard);
});

updateJobcardButton.addEventListener("click", async function (event) {
    editJobcardForm.querySelector("#success_text").style.display = "block";
    editJobcardForm.querySelector("#success_text").textContent = "Updating...";
    event.preventDefault();
    const jobcardId = editJobcardForm.dataset.jobcardId;
    const url = appRoutes.updateJobcard.replace("VEHICLE_ID", jobcardId);
    await handleRequest(event, editJobcardForm, url, true);
});

showAddJobcardButton.addEventListener("click", function (e) {
    const vehicle = JSON.parse(e.target.dataset.vehicle);
    const vehicleNumberElement =
        addJobcardForm.querySelector("#vehicle_number");
    vehicleNumberElement.textContent = `Vehicle Number: ${vehicle.vehicle_number}`;
    addJobcardForm.dataset.vehicleId = vehicle.id;
});
editJobcardButton.addEventListener("click", function (e) {
    const jobcard = JSON.parse(e.target.dataset.jobcard);

    editJobcardForm.dataset.jobcardId = jobcard.id;
    const $columns = [
        "jobcard_number",
        "make",
        "model",
        "fuel_type",
        "owner_name",
        "owner_contact",
        "secondary_number",
        "email",
        "address",
    ];

    $columns.forEach((column) => {
        const inputField = editJobcardForm.querySelector("#" + column);
        if (inputField) {
            inputField.value = jobcard[column] ?? "";
        }
    });
    const currentImage = editJobcardForm.querySelector(
        "#current_jobcard_image"
    );
    const imageUrl = e.target.dataset.jobcard_image;
    if (imageUrl && imageUrl !== "undefined") {
        currentImage.src = imageUrl;
        currentImage.style.display = "block";
    } else {
        currentImage.style.display = "none";
    }
});
