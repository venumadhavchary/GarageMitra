const sendOtpButton = document.querySelector("#send_otp");
const resendOtpButton = document.querySelector("#resend_otp");
const phoneNumberField = document.querySelector("#mobile_number");
const loginField = document.querySelector("#login_field");
const loginButton = document.querySelector("#login_button");
const errorMessage = document.querySelector("#error_text");
const successMessage = document.querySelector("#success_text");

async function handleOtpRequest(isResend = false) {
    if (phoneNumberField.value.length !== 10) {
        errorMessage.innerText = "Please enter a valid 10-digit mobile number.";
        errorMessage.style.display = "block";
        return;
    }
    const dataToSend = {
        mobile_number: phoneNumberField.value,
    };

    errorMessage.style.display = "none";

    try {
        const response = await fetch(
            isResend ? appRoutes.resendOtp : appRoutes.sendOtp,
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json", // <--- ADD THIS LINE
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(dataToSend),
            }
        );
        const data = await response.json();

        if (response.ok) {
            console.log("OTP sent successfully:", data);
 
            sendOtpButton.style.display = "none";
            loginField.style.display = "block";
            phoneNumberField.readOnly = true;
            successMessage.style.display = "block";
            successMessage.innerText =
                "OTP sent successfully to " + phoneNumberField.value;
        } else {
            throw new Error(data.message || "Something went wrong");
        }
    } catch (error) {
        successMessage.style.display = "none";
        console.error("Error:", error);
        errorMessage.innerText = error.message;
        errorMessage.style.display = "block";
    }
}
if (sendOtpButton) {
    sendOtpButton.addEventListener("click", async function (e) {
        e.preventDefault();
        handleOtpRequest(false); // false = first send
    });
}

if (resendOtpButton) {
    resendOtpButton.addEventListener("click", async function (e) {
        e.preventDefault();
        handleOtpRequest(true); // true = resend
    });
}
if (loginButton){
    loginButton.addEventListener("click", async function (e) {
        e.preventDefault();
        const otpValue = document.querySelector("#otp").value;
        if (otpValue.length === 0) {
            errorMessage.innerText = "Please enter the OTP.";
            errorMessage.style.display = "block";
        }
        errorMessage.style.display = "none";

        const dataToSend = {
            mobile_number: phoneNumberField.value,
            otp: otpValue,
        };

        console.log("Logging in with data:", dataToSend);
        try {
            const response = await fetch(appRoutes.login, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify(dataToSend),
            });
            const data = await response.json();
            if (response.ok) {
                console.log("Login successful:", data);
                window.location.href = data.redirect_url;
            } else {
                throw new Error(data.message || "Login failed");
            }
        } catch (error) {
            console.error("Error:", error);
            errorMessage.innerText = error.message;
            errorMessage.style.display = "block";
        }
    });
}

const registerButton = document.querySelector("#register_button");

if (registerButton) {
    registerButton.addEventListener("click", async function (e) {
        e.preventDefault();

        console.log("Register button clicked");
        const name = document.querySelector("#name").value;
        const email = document.querySelector("#email").value;
        const shop_name = document.querySelector("#shop_name").value;
        const state = document.querySelector("#state").value;
        const address = document.querySelector("#address").value;
        const gstin = document.querySelector("#gstin").value;

        const formData = new FormData();
        formData.append("name", name);
        formData.append("email", email);
        formData.append("shop_name", shop_name);
        formData.append("state", state);
        formData.append("address", address);
        formData.append("gstin", gstin);
        formData.append("mobile_number", phoneNumberField.value);

         
        try {
            const response = await fetch(appRoutes.register, {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: formData,
            });
            //if response is not json and if html return somwething went wrong
            if (
                response.headers
                    .get("content-type")
                    .indexOf("application/json") === -1
            ) {
                throw new Error("Something went wrong");
            }

            const data = await response.json();

            if (response.ok) {
                console.log("Registration successful:", data);
                window.location.href = data.redirect_url;
            } else {
                throw new Error(data.message || "Registration failed");
            }
        } catch (error) {
            console.error("Error:", error);
            errorMessage.innerText = error.message;
            errorMessage.style.display = "block";
        }
    });
}
