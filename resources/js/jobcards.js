import { handleRequest } from "./api.js";

const addJobcardForm = document.getElementById("add_jobcard_form");
const editJobcardForm = document.getElementById("edit_jobcard_form");
const addJobcardButton = document.getElementById("add_jobcard_button");
const updateJobcardButton = document.getElementById("update_jobcard_button");
const completeJobcardButton = document.getElementById(
    "complete_jobcard_button"
);
const completeJobcardForm = document.getElementById("complete_jobcard_form");
if (addJobcardButton && addJobcardForm) {
    addJobcardButton.addEventListener("click", async function (event) {
        event.preventDefault();
        const formData = new FormData(addJobcardForm);
        await handleRequest(event, addJobcardForm, appRoutes.addJobcard);
    });
}
if (updateJobcardButton) {
    updateJobcardButton.addEventListener("click", async function (event) {
        console.log("Update jobcard button clicked");
        event.preventDefault();
        editJobcardForm.querySelector("#success_text").style.display = "block";
        editJobcardForm.querySelector("#success_text").textContent =
            "Updating...";
        const formData = new FormData(editJobcardForm);
        
        const url = appRoutes.updateJobcard;

        console.log("updated url:", url);
        await handleRequest(event, editJobcardForm, url, true);
    });
}

if (completeJobcardButton && completeJobcardForm) {
    completeJobcardButton.addEventListener("click", async function (event) {
        event.preventDefault(); 
        console.log("Complete jobcard button clicked");
        const formData = new FormData(editJobcardForm); 
         
        const url = appRoutes.completeJobcard;

        completeJobcardButton.disabled = true;
        completeJobcardButton.innerHTML = "⏳ Processing...";

        try {
            await handleRequest(event, completeJobcardForm, appRoutes.completeJobcard, true);
        } finally {
            completeJobcardButton.disabled = false;
            completeJobcardButton.innerHTML = "Confirm";
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Services: show/hide and toggle required/disabled
    const otherServiceCheckbox = document.getElementById("other_service");
    const otherServiceWrapper = document.getElementById("other_service_input");
    const otherServiceText = document.getElementById("other_service_text");

    if (otherServiceCheckbox && otherServiceWrapper && otherServiceText) {
        function setOtherService(show) {
            otherServiceWrapper.style.display = show ? "block" : "none";
            otherServiceText.disabled = !show;
            otherServiceText.required = show;
        }
        setOtherService(false);
        otherServiceCheckbox.addEventListener("change", function () {
            setOtherService(this.checked);
        });
    }

    // Vehicle Received From: radios
    const recOwnerRadio = document.getElementById(
        "vehicle_received_from_owner"
    );
    const recOtherRadio = document.getElementById(
        "vehicle_received_from_other"
    );
    const recInputWrap = document.getElementById("vehicle_received_from_input");
    const recInputText = document.getElementById("vehicle_received_from_text");

    if (recOwnerRadio && recOtherRadio && recInputWrap && recInputText) {
        function showRecInput(show) {
            recInputWrap.style.display = show ? "block" : "none";
            recInputText.disabled = !show;
            recInputText.required = show;
        }
        showRecInput(false);
        recOtherRadio.addEventListener("change", () =>
            showRecInput(recOtherRadio.checked)
        );
        recOwnerRadio.addEventListener("change", () => {
            if (recOwnerRadio.checked) showRecInput(false);
        });
    }

    // Vehicle Collected By: radios
    const colOwnerRadio = document.getElementById("vehicle_returned_to_owner");
    const colOtherRadio = document.getElementById("vehicle_returned_to_other");
    const colInputWrap = document.getElementById("vehicle_returned_to_input");
    const colInputText = document.getElementById("vehicle_returned_to_text");

    if (colOwnerRadio && colOtherRadio && colInputWrap && colInputText) {
        function showColInput(show) {
            colInputWrap.style.display = show ? "block" : "none";
            colInputText.disabled = !show;
            colInputText.required = show;
        }
        showColInput(false);
        colOtherRadio.addEventListener("change", () =>
            showColInput(colOtherRadio.checked)
        );
        colOwnerRadio.addEventListener("change", () => {
            if (colOwnerRadio.checked) showColInput(false);
        });
    }
});

const imageInput = document.getElementById("multiImageInput");
const uploadWrapper = document.getElementById("imageUploadWrapper");
const uploadBox = document.getElementById("imageUploadBox");
let selectedFiles = [];
if (imageInput) {
    imageInput.addEventListener("change", function (e) {
        const files = Array.from(e.target.files);

        files.forEach((file) => {
            if (file.type.startsWith("image/")) {
                selectedFiles.push(file);
                const index = selectedFiles.length - 1;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement("div");
                    div.className = "image-preview-item";
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
        imageInput.value = "";
    });
}

function removeImage(index) {
    selectedFiles[index] = null;
    const item = document.querySelector(
        `.image-preview-item[data-index="${index}"]`
    );
    if (item) item.remove();
}

const oldJobCheckbox = document.getElementById("old_job");
if (oldJobCheckbox) {
    oldJobCheckbox.addEventListener("change", function () {
        const jobcardNumberInput = document.getElementById("assigned_date");
        if (this.checked) {
            jobcardNumberInput.removeAttribute("readonly");
        } else {
            jobcardNumberInput.setAttribute("readonly", "readonly");
        }
    });
}

const otherServiceCheckbox2 = document.getElementById("other_service");
if (otherServiceCheckbox2) {
    otherServiceCheckbox2.addEventListener("change", function () {
        const inputBox = document.getElementById("other_service_input");
        if (this.checked) {
            inputBox.style.display = "block";
        } else {
            inputBox.style.display = "none";
        }
    });
}

const vehicleReceivedOther = document.getElementById(
    "vehicle_recieved_from_other"
);
if (vehicleReceivedOther) {
    vehicleReceivedOther.addEventListener("change", function () {
        const inputBox = document.getElementById("vehicle_recieved_from_input");
        if (this.checked) {
            inputBox.style.display = "block";
        } else {
            inputBox.style.display = "none";
        }
    });
}

const vehicleReceivedOwner = document.getElementById(
    "vehicle_received_from_owner"
);
if (vehicleReceivedOwner) {
    vehicleReceivedOwner.addEventListener("change", function () {
        document.getElementById("vehicle_recieved_from_input").style.display =
            "none";
    });
}

const vehicleCollectedOther = document.getElementById(
    "vehicle_collected_by_other"
);
if (vehicleCollectedOther) {
    vehicleCollectedOther.addEventListener("change", function () {
        const inputBox = document.getElementById("vehicle_collected_by_input");
        if (this.checked) {
            inputBox.style.display = "block";
        } else {
            inputBox.style.display = "none";
        }
    });
}

const vehicleCollectedOwner = document.getElementById(
    "vehicle_collected_by_owner"
);
if (vehicleCollectedOwner) {
    vehicleCollectedOwner.addEventListener("change", function () {
        document.getElementById("vehicle_collected_by_input").style.display =
            "none";
    });
}

const vehicleReturnedOther = document.getElementById(
    "vehicle_returned_to_other"
);
if (vehicleReturnedOther) {
    vehicleReturnedOther.addEventListener("change", function () {
        const inputBox = document.getElementById("vehicle_returned_to_input");
        const phoneInput = document.getElementById(
            "vehicle_returned_to_phone_input"
        );
        if (this.checked) {
            inputBox.style.display = "block";
            phoneInput.style.display = "block";
        } else {
            inputBox.style.display = "none";
            phoneInput.style.display = "none";
        }
    });
}

const vehicleReturnedOwner = document.getElementById(
    "vehicle_returned_to_owner"
);
if (vehicleReturnedOwner) {
    vehicleReturnedOwner.addEventListener("change", function () {
        document.getElementById("vehicle_returned_to_input").style.display =
            "none";
        document.getElementById(
            "vehicle_returned_to_phone_input"
        ).style.display = "none";
    });
}


// View Job
function viewJob(id) {
    window.location.href = `/jobcards/${id}`;
}




const discountForm = document.getElementById('discount_form');
const updateDiscount = document.getElementById('update_discount');
if( updateDiscount && discountForm){
    console.log("Discount form and button found");
    updateDiscount.addEventListener('click', async function(event){
        event.preventDefault();
        updateDiscount.disabled = true;
        updateDiscount.innerHTML = '⏳ Updating...';

        try{
            const res = await handleRequest(event, discountForm, appRoutes.updateDiscountUrl, true);
            if(res && res.balance_amount){
                const totalAmount = document.getElementById('total_amount');
                totalAmount.textContent = parseFloat(res.balance_amount).toFixed(2);
            }
            if(res && res.discount_amount){
                const totalDiscount = document.getElementById('total_discount');
                totalDiscount.textContent = parseFloat(res.discount_amount).toFixed(2);
            }
        } finally {
            updateDiscount.disabled = false;
            updateDiscount.innerHTML = 'Apply';
        }
    });
}

const paidAmountForm = document.getElementById('paid_amount_form');
const updatePaidAmount = document.getElementById('update_paid_amount');
if( paidAmountForm && updatePaidAmount){
    console.log("Paid amount form and button found");
    updatePaidAmount.addEventListener('click', async function(event){
        event.preventDefault();
        updatePaidAmount.disabled = true;
        updatePaidAmount.innerHTML = '⏳ Updating...';

        try{
            const res = await handleRequest(event, paidAmountForm, appRoutes.updatePaidAmountUrl, true);
            console
            if(res && res.balance_amount){
                const totalAmount = document.getElementById('total_amount');
                totalAmount.textContent = parseFloat(res.balance_amount).toFixed(2);
            }
            if(res && res.paid_amount){
                const paidAmount = document.getElementById('total_paid_amount');
                console.log("paid amount:", paidAmount);
                console.log("Updating paid amount to:", res.paid_amount);
                paidAmount.textContent = parseFloat(res.paid_amount).toFixed(2);
            }
            if(res && res.status === 'paid'){
                console.log("Updating payment status badge to paid");
                const statusBadge = document.getElementById('payment_status_badge');
                statusBadge.style.display = 'block';
                statusBadge.textContent = '✅ Payment Completed!';
            }
        } finally {
            updatePaidAmount.disabled = false;
            updatePaidAmount.innerHTML = 'Update';
        }
    });
}









window.removeImage = removeImage;

