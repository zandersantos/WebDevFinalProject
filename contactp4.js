/********w*************
    
Project 4
    Name: Zander Santos
    Date: April. 18, 2024
    Description: Contact Page Javascript.


*********************/

function validate(e) {
    e.preventDefault();  // Prevent form submission on submit button

    hideAllErrors();

    if (formHasErrors()) {
        return false;  // Prevent further actions if there are errors
    }

    // If no errors, you can submit the form here manually or perform other actions
    alert("Form submitted successfully!");  // For testing purposes
    // e.target.submit();  // Uncomment this line if you want to manually submit the form
}

function formHasErrors() {
    let errorFlag = false;

    let requiredFields = ["fullname", "phone", "email"];
    for (let i = 0; i < requiredFields.length; i++) {
        let textField = document.getElementById(requiredFields[i]);
        if (textField.value == null || textField.value.trim() === "") {
            document.getElementById(requiredFields[i] + "_error").style.display = "block";
            errorFlag = true;
        }
    }

    let emailField = document.getElementById("email");
    if (!validateEmail(emailField.value.trim()) && emailField.value.trim() !== "") {
        document.getElementById("email_error2").style.display = "block";
        errorFlag = true;
    }

    let phoneField = document.getElementById("phone");
    if (!validatePhone(phoneField.value.trim()) && phoneField.value.trim() !== "") {
        document.getElementById("phone_error2").style.display = "block";
        errorFlag = true;
    }

    return errorFlag;
}

function hideAllErrors() {
    let errorItems = document.querySelectorAll(".error");
    errorItems.forEach((errorItem) => {
        errorItem.style.display = "none";
    });
}

function validateEmail(email) {
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailRegex.test(email);
}

function validatePhone(phone) {
    let phoneRegex = /^[0-9]{9}$/; // Matches exactly 9 digits
    return phoneRegex.test(phone);
}

function resetText() {
    hideAllErrors(); // Clear errors on reset
    let formFields = document.querySelectorAll("#contactForm input, #contactForm textarea");
    formFields.forEach((field) => {
        field.value = ""; // Clear all input fields
    });
}

function load() {
    let form = document.getElementById("contactForm");
    form.addEventListener("submit", validate);

    let reset = document.querySelector(".resetbutton");
    reset.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent default reset action
        resetText();
    });
}

document.addEventListener("DOMContentLoaded", load);
