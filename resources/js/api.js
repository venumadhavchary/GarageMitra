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

        if (!response.ok) {
            if (response.status === 422 && data.errors) {
                // Laravel validation errors
                displayValidationErrors(form, data.errors, errorMessage);
                throw new Error("Validation failed");
            }
            throw new Error(
                data.message ||
                    "An error occurred while processing the request."
            );
        }

        if (data && data.status === "error" && data.message) {
            throw new Error(data.message);
        }
        // Clear all field errors on success
        clearFieldErrors(form);
        errorMessage.style.display = "none";
        successMessage.style.display = "block";
        successMessage.textContent = data.message || "Success.";
        if (data.url) {
            window.location.href = data.url;
            return;
        }
        setTimeout(() => {
            window.location.reload();
        }, 500);
    } catch (error) {
        console.error("Error during request:", error);
        for (const err of Object.values(error || {})) {
            if (Array.isArray(err)) {
                errorMessage.innerHTML += err.join("<br>") + "<br>";
            } else {
                errorMessage.innerHTML += err + "<br>";
            }
        }
        console.log('Error ', error);
        successMessage.style.display = "none";
    }
}
function displayValidationErrors(form, errors, generalErrorElement) {
    // Clear previous errors
    clearFieldErrors(form);

    let hasGeneralError = false;

    // Display errors per field
    for (const [fieldName, fieldErrors] of Object.entries(errors)) {
        const field = form.querySelector(`[name="${fieldName}"]`);
        const errorElement = form.querySelector(`#${fieldName}_error`);

        if (field && errorElement) {
            // Display field-specific error
            const errorText = Array.isArray(fieldErrors)
                ? fieldErrors[0]
                : fieldErrors;
            errorElement.textContent = errorText;
            errorElement.style.display = "block";

            // // Add error class to field
            // field.classList.add("error");
        } else {
            // If no field element found, add to general errors
            hasGeneralError = true;
        }
    }

    // Display general errors
    if (hasGeneralError || Object.keys(errors).length === 0) {
        const errorTexts = [];
        for (const [, fieldErrors] of Object.entries(errors)) {
            if (Array.isArray(fieldErrors)) {
                errorTexts.push(...fieldErrors);
            } else {
                errorTexts.push(fieldErrors);
            }
        }

        if (errorTexts.length > 0) {
            generalErrorElement.innerHTML = errorTexts.join("<br>");
            generalErrorElement.style.display = "block";
        }
    }

    // Focus on first error field
    const firstErrorField = form.querySelector(".error");
    if (firstErrorField) {
        firstErrorField.focus();
    }
}

function clearFieldErrors(form) {
    // Remove error class from all fields
    form.querySelectorAll(".error").forEach((field) => {
        field.classList.remove("error");
    });

    // Hide all field error messages
    form.querySelectorAll("[id$='_error']").forEach((errorEl) => {
        errorEl.style.display = "none";
        errorEl.textContent = "";
    });
}

window.openModal = function (modalId, data = null) {
    const modal = document.getElementById(modalId);
    modal.classList.remove("hide");
    modal.classList.add("show");

    if (data) {
        modal.dataset.inputId = data.id;

        Object.keys(data).forEach(key => { 
            const input = modal.querySelector(`[name="${key}"]`);
            if (input) {
                input.value = data[key];
            }
        });
    }
};

window.closeModal = function (modalId) {
    document.getElementById(modalId).classList.remove("show");
    document.getElementById(modalId).classList.add("hide");
};
