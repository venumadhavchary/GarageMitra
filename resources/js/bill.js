let sparePartsCounter = 0;
let servicesCounter = 0;
let labourChargeCounter = 0;
const AddSpare = document.getElementById("add_spare_button");

const spares = [];

AddSpare.addEventListener("click", function () {
    const addSpareForm = document.getElementById("add_spare_form");
    const formData = new FormData(addSpareForm);
    //loop and name data
    const $names = ["spare_name", "quantity", "unit_price"];
    //loop and return
    let error = 0;
    $names.forEach((name) => {
        const value = formData.get(name);
        if (!value) {
            error++;
            addSpareForm.querySelector("#" + name + "_error").textContent =
                name.replace("_", " ") + " is required.";
        }
    });
    if (error > 0) {
        return;
    }

    const quantity = formData.get("quantity");
    const unitPrice = formData.get("unit_price");

    //if not integer show error
    if (!Number.isInteger(Number(quantity))) {
        addSpareForm.querySelector("#quantity_error").textContent =
            "Quantity must be an numberic.";
        return;
    }
    if (!Number.isInteger(Number(unitPrice))) {
        addSpareForm.querySelector("#unit_price_error").textContent =
            "Unit Price must be numberic.";
        return;
    }
    const spareName = formData.get("spare_name");
    spares.push({ spareName, quantity, unitPrice });
    console.log("spares:", spares);
    //if all pass add spare part to bill table
    addSpareAndLabour(spareName, quantity, unitPrice);

    addSpareForm.reset();
});

function addSpareAndLabour(spareName, quantity, unitPrice) {
    const spareTableBody = document.getElementById("bill_table_body");
    const spareId = spareTableBody.children.length + 1;
    const spareRow = document.createElement("tr");
    spareRow.setAttribute("data-index", spareId);

    const totalPrice = (quantity * unitPrice).toFixed(2);

    spareRow.innerHTML = `
                <td style="padding-left: 1.5rem;">${spareId}</td>
                <td>
                    ${spareName} -   ${quantity}
                    <input type="hidden" name="spare_parts[${sparePartsCounter}][id]" value="${spareId}">
                    <input type="hidden" name="spare_parts[${sparePartsCounter}][name]" value="${spareName}">
                    <input type="hidden" name="spare_parts[${sparePartsCounter}][qty]" value="${quantity}">
                </td>
                <td>
                    ${unitPrice}
                    <input type="hidden" name="spare_parts[${sparePartsCounter}][price_per_unit]" value="${unitPrice}">
                </td>
                <td>
                    ${totalPrice}
                    <input type="hidden" name="spare_parts[${sparePartsCounter}][total_price]" value="${totalPrice}">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSpareRow(this)">
                        🗑️
                    </button>
                </td>
            `;
    spareTableBody.appendChild(spareRow);
    sparePartsCounter++;


    const labourFor = "Labour charges for " + spareName;
    const labourTableBody = document.getElementById("labour_charge_table_body");
    const labourId = labourTableBody.children.length + 1;
    const labourRow = document.createElement("tr");
    labourRow.setAttribute("data-index", labourId);
    labourRow.setAttribute("data-spare-index", spareId );
    labourRow.innerHTML = `
                <td style="padding-left: 1.5rem;">${labourId}</td>
                <td>
                    ${labourFor}
                    <input type="hidden" name="labour_charges[${labourChargeCounter}][id]" value="${labourId}">
                    <input type="hidden" name="labour_charges[${labourChargeCounter}][name]" value="${labourFor}">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" 
                           name="labour_charges[${labourChargeCounter}][charge]" 
                           value="0" min="0" step="100" 
                           oninput="calculateTotal()">
                </td> 
            `;
    labourTableBody.appendChild(labourRow);
    labourChargeCounter++;

    calculateTotal();

    closeModal("add_spare_part");
}

function removeSpareRow(button) {
    const row = button.closest("tr");
    const spareId = row.getAttribute("data-index");

    row.remove();

    const labourRow = document.querySelector(
        `#labour_charge_table_body tr[data-index="${spareId}"]`
    );
    console.log("Removing linked labour row:", labourRow);
    if (labourRow) {
        labourRow.remove();
    }

    updateSparePartIds();
    updateLabourChargeIds();

    calculateTotal();
}

function updateSparePartIds() {
    const sprareRows = document.querySelectorAll("#bill_table_body tr");
    sprareRows.forEach((row, index) => {
        const idCell = row.querySelector("td:first-child");
        idCell.textContent = index + 1;

        const idInput = row.querySelector('input[name*="[id]"]');
        if (idInput) {
            idInput.value = index + 1;
        }
    });
}
function updateLabourChargeIds() {
    const labourRows = document.querySelectorAll("#labour_charge_table_body tr");
    labourRows.forEach((row, index) => {
        const idCell = row.querySelector("td:first-child");
        idCell.textContent = index + 1;

        const idInput = row.querySelector('input[name*="[id]"]');
        if (idInput) {
            idInput.value = index + 1;
        }
    });
}
const addServiceButton = document.getElementById("add_service_button");

const services = [];

addServiceButton.addEventListener("click", function () {
    const addServiceForm = document.getElementById("add_service_form");
    const formData = new FormData(addServiceForm);
    //loop and name data
    let error = 0;
    const $names = ["service_name", "price"];
    $names.forEach((name) => {
        const value = formData.get(name);
        if (!value) {
            error++;
            addServiceForm.querySelector("#" + name + "_error").textContent =
                name.replace("_", " ") + " is required.";
        }
    });
    if (error > 0) {
        return;
    }
    const serviceName = formData.get("service_name");
    const price = formData.get("price");

    if (!Number.isInteger(Number(price))) {
        addServiceForm.querySelector("#price").textContent =
            "Price must be an numberic.";
        return;
    }

    services.push({ serviceName, price });
    console.log("services:", services);
    //if all pass add spare part to bill table
    addServiceToTable(serviceName, price);

    addServiceForm.reset();
});



 
function addServiceToTable(name, price) {
    const serviceTableBody = document.getElementById("services_table_body");
    const row = document.createElement("tr");
    const id = serviceTableBody.children.length + 1;
    row.innerHTML = `
                <tr data-index="${servicesCounter}">
                    <td style="padding-left: 1.5rem;">${id}</td>
                    <td>
                        ${name}
                        <input type="hidden" name="services[${servicesCounter}][id]" value="${id}">
                        <input type="hidden" name="services[${servicesCounter}][name]" value="${name}">
                    </td>
                    <td>
                        ${price}
                        <input type="hidden" name="services[${servicesCounter}][price]" value="${price}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this, 'service')">
                            🗑️
                        </button>
                    </td>
                </tr>
            `;

    serviceTableBody.appendChild(row);
    calculateTotal();
    servicesCounter++;
    closeModal("add_service");
}

function calculateTotal() {
    let total = 0;

    document
        .querySelectorAll('#bill_table_body input[name*="[total_price]"]')
        .forEach((input) => {
            total += parseFloat(input.value) || 0;
        });
    document
        .querySelectorAll('#services_table_body input[name*="[price]"]')
        .forEach((input) => {
            total += parseFloat(input.value) || 0;
        });

    document
        .querySelectorAll('#labour_charge_table_body input[name*="[charge]"]')
        .forEach((input) => {
            total += parseFloat(input.value) || 0;
        });

    const additionalCharge =
        parseFloat(document.getElementById("additional_labour_charge").value) ||
        0;
    total += additionalCharge;

    document.getElementById("estimated_cost").value = total.toFixed(2);
}

document
    .getElementById("additional_labour_charge")
    .addEventListener("input", calculateTotal);


window.calculateTotal = calculateTotal;
window.removeSpareRow = removeSpareRow;