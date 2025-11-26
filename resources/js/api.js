export async function handleRequest(event, form, url, isUpdate = false) {
    event.preventDefault();
    const formData = new FormData(form);

    // For PUT requests, add _method field for Laravel method spoofing
    if (isUpdate) {
        formData.append("_method", "PUT");
    }

    // Debug
    console.log("FormData entries:", [...formData.entries()]);

    const errorMessage = form.querySelector("#error_text");
    const successMessage = form.querySelector("#success_text");
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
        if (!response.ok) {
            throw new Error(data.message || "An error occurred.");
        }
        if (data && data.status === "error" && data.message) {
            throw new Error(data.message);
        }
        errorMessage.style.display = "none";
        successMessage.style.display = "block";
        successMessage.textContent = data.message || "Success.";
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    } catch (error) {
        console.error(error.message);

        errorMessage.textContent =
            error.message || "An error occurred. Please try again.";
        errorMessage.style.display = "block";
        successMessage.style.display = "none";
    }
}
function displayErrors(form, errors) {
    // Clear previous errors
    clearErrors(form);
    
    // Display new errors
    Object.keys(errors).forEach(fieldName => {
        const errorElement = form.querySelector(`#${fieldName}_error`);
        if (errorElement) {
            errorElement.textContent = errors[fieldName][0];
            errorElement.style.display = 'block';
        }
    });
}

function clearErrors(form) {
    const errorElements = form.querySelectorAll('[id$="_error"]');
    errorElements.forEach(el => {
        el.textContent = '';
        el.style.display = 'none';
    });
}