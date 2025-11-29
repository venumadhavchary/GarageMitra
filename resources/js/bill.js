const AddSpare = document.getElementById('add_spare_button');

const spares = [];

AddSpare.addEventListener('click', function(){
    const addSpareForm = document.getElementById('add_spare_form');
    const formData = new FormData(addSpareForm);
    //loop and name data
    const $names = ['spare_name', 'quantity', 'unit_price'];
    //loop and return 
    let error = 0;
    $names.forEach(name => {
        const value = formData.get(name);
        if(!value){
            error++;
            addSpareForm.querySelector('#' + name + '_error').textContent = name.replace('_', ' ') + " is required.";
        } 
    });
    if(error > 0){
        return;
    }

    
    const quantity = formData.get('quantity');
    const unitPrice = formData.get('unit_price');

    //if not integer show error
    if(!Number.isInteger(Number(quantity))){
        addSpareForm.querySelector('#quantity_error').textContent = "Quantity must be an numberic.";
        return;
    }
    if(!Number.isInteger(Number(unitPrice))){
        addSpareForm.querySelector('#unit_price_error').textContent = "Unit Price must be numberic.";
        return;
    }
    const spareName = formData.get('spare_name');
    spares.push({spareName, quantity, unitPrice});
    console.log('spares:', spares);
    //if all pass add spare part to bill table
    addSpareAndLabour(spareName, quantity, unitPrice);

    addSpareForm.reset();

});

function addSpareAndLabour(spareName, quantity, unitPrice){
    const spareTableBody = document.getElementById('bill_table_body');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${spareTableBody.children.length + 1}</td>
        <td>${spareName} - ${quantity}</td>
        <td>${unitPrice}</td>
        <td>${quantity * unitPrice}</td>
    `;
    spareTableBody.appendChild(row);

    const labourFor = "Labour charges for " + spareName;
    const labourTableBody = document.getElementById('labour_charge_table_body');
    const labour_row = document.createElement('tr');
    labour_row.innerHTML = `
        <td>${labourTableBody.children.length + 1}</td>
        <td>${labourFor}</td>
        <td></td> 
    `;
    labourTableBody.appendChild(labour_row);
    closeModal('add_spare_part');
}


const addServiceButton = document.getElementById('add_service_button');

const services = [];

addServiceButton.addEventListener('click', function(){
    const addServiceForm = document.getElementById('add_service_form');
    const formData = new FormData(addServiceForm);
    //loop and name data
    let error = 0;
    const $names = ['service_name', 'price'];
    $names.forEach(name => {
        
        const value = formData.get(name);
        if(!value){
            error++;
            addServiceForm.querySelector('#' + name + '_error').textContent = name.replace('_', ' ') + " is required.";
        }
    });
    if(error>0){
        return;
    }
    const serviceName = formData.get('service_name');
    const price = formData.get('price');

     
    if(!Number.isInteger(Number(price))){
        addServiceForm.querySelector('#price').textContent = "Price must be an numberic.";
        return;
    } 
    
    services.push({serviceName, price});
    console.log('services:', services);
    //if all pass add spare part to bill table
    addServiceToTable(serviceName, price);

    addServiceForm.reset();

});

function addServiceToTable(serviceName, price){
    const serviceTableBody = document.getElementById('services_table_body');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td>${serviceTableBody.children.length + 1}</td>
        <td>${serviceName}</td>
        <td>${price}</td>
    `;
    serviceTableBody.appendChild(row); 
    closeModal('add_service');
}
