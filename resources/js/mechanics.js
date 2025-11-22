const addMechanicForm = document.getElementById("add_mechanic_form");
const updateMechanicForm = document.getElementById("update_mechanic_form");
const addMechanicButton = document.getElementById("add_mechanic_button");
const updateMechanicButton = document.getElementById("update_mechanic_button");

addMechanicButton.addEventListener("click", async function (event) {
    event.preventDefault();
    const formData = new FormData(addMechanicForm);
    await handleRequest(event, addMechanicForm, appRoutes.addMechanic);
});

updateMechanicButton.addEventListener("click", async function (event) {
    document.querySelector('#update_mechanic #success_text').style.display = "block";
    document.querySelector('#update_mechanic #success_text').textContent = "Updating mechanic..."; 
    event.preventDefault();
    const mechanicId = updateMechanicForm.dataset.mechanicId;
    const url = appRoutes.updateMechanic.replace("MECHANIC_ID", mechanicId);
    await handleRequest(event, updateMechanicForm, url, true);
});

async function handleRequest(event, form, url, isUpdate = false) {
    event.preventDefault();
    const formData = new FormData(form); 
    
    // For PUT requests, add _method field for Laravel method spoofing
    if (isUpdate) {
        formData.append('_method', 'PUT');
    }
    
    // Debug
    console.log('FormData entries:', [...formData.entries()]);

    const function_name = isUpdate ? "update_mechanic" : "add_mechanic";
    const errorMessage = document.querySelector(
        `#${function_name} #error_text`
    );
    const successMessage = document.querySelector(
        `#${function_name} #success_text`
    );
    try {
        // Always use POST - Laravel will detect _method=PUT and route correctly
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                Accept: "application/json",
            },
            body: formData,
        });
        const data = await response.json();
        console.log("Response data:", data);
        if (response.ok) {
            errorMessage.style.display = "none";
            successMessage.style.display = "block";
            successMessage.textContent = data.message || "Success.";
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            throw new Error(data.message || "An error occurred");
        }
    } catch (error) {
        console.error("Error:", error);

        errorMessage.textContent =
            error || "An error occurred. Please try again.";
        errorMessage.style.display = "block";
        successMessage.style.display = "none";
    }
}

$("#update_mechanic").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var modal = $(this);

    const name = document.querySelector("#update_mechanic #name");
    const specialization = document.querySelector("#update_mechanic #specialization");
    const phone = document.querySelector("#update_mechanic #phone"); 

    updateMechanicForm.dataset.mechanicId = button.data("id");
    name.value = button.data("name");
    specialization.value = button.data("specialization");
    phone.value = button.data("phone");
 
});
