import { handleRequest } from './api.js';


const addMechanicForm = document.getElementById("add_mechanic_form");
const updateMechanicForm = document.getElementById("update_mechanic_form");
const addMechanicButton = document.getElementById("add_mechanic_button");
const updateMechanicButton = document.getElementById("update_mechanic_button");

// console.log(typeof handleRequest);
addMechanicButton.addEventListener("click", async function (event) {
    event.preventDefault();
    const formData = new FormData(addMechanicForm);
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
