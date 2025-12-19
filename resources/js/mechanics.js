import { handleRequest } from './api.js';


const addMechanicForm = document.getElementById("add_mechanic_form");
const updateMechanicForm = document.getElementById("update_mechanic_form");
const addMechanicButton = document.getElementById("add_mechanic_button");
const updateMechanicButton = document.getElementById("update_mechanic_button");
const editMechanicButtons = document.querySelectorAll(".edit-mechanic-btn");

// console.log(typeof handleRequest);
addMechanicButton.addEventListener("click", async function (event) {
    event.preventDefault();
    await handleRequest(event, addMechanicForm, appRoutes.addMechanic);
});

updateMechanicButton.addEventListener("click", async function (event) {
    updateMechanicForm.querySelector('#success_text').style.display = "block";
    updateMechanicForm.querySelector('#success_text').textContent = "Updating mechanic..."; 
    event.preventDefault();
    const mechanicId = updateMechanicForm.dataset.mechanicId;
    const url = appRoutes.updateMechanic.replace("MECHANIC_ID", mechanicId);
    await handleRequest(event, updateMechanicForm, url, true);
});


if (editMechanicButtons.length > 0 && updateMechanicForm) {
    editMechanicButtons.forEach(button => {
        button.addEventListener("click", function(e) {
            const mechanicData = e.currentTarget.dataset.mechanic;
            if (!mechanicData) return;
            const mechanic = JSON.parse(mechanicData);

            updateMechanicForm.dataset.mechanicId = mechanic.id;
            updateMechanicForm.querySelector('[name="name"]').value = mechanic.name ?? '';
            updateMechanicForm.querySelector('[name="specialization"]').value = mechanic.specialization ?? '';
            updateMechanicForm.querySelector('[name="phone"]').value = mechanic.phone ?? '';

            // Hide previous alerts
            const alerts = updateMechanicForm.querySelectorAll('.alert');
            alerts.forEach(alert => alert.style.display = 'none');

            // Open the modal
            openModal('update_mechanic');
        });
    });
}

