/*
    Final Project
    Name: Zander Santos
    Date: November. 24, 2024
    Description: Critical Components Contact Validation Page

    Client Comment: This is the Contact Validation page for Critical Components. 
    This JavaScript file validates the Contact Page form, ensuring all required fields are 
    filled out correctly and providing error messages for invalid input. 
    It also includes a reset function to clear the form.

    *All commments within "* *" are Client side Comments
    !All comments within "! !" are Technical side Comments
*/

// * This function validates the form when the user clicks the submit button. If there are any errors, 
// the form won't be submitted, and error messages will be displayed. *
function validate(e) {
    e.preventDefault();  // !Prevent form submission on submit button!

    // * Clear any existing error messages. *
    hideAllErrors();

    // * Check if there are any errors in the form. *
    if (formHasErrors()) {
        return false;  // !Prevent further actions if there are errors!
    }

    // !If no errors, you can submit the form here manually or perform other actions!
    alert("Form submitted successfully!");  // For testing purposes
    //! e.target.submit();  // Uncomment this line if you want to manually submit the form!
}
// * This function checks the form for errors, such as missing required fields 
// or invalid email/phone formats. It displays the corresponding error messages. *
function formHasErrors() {
    let errorFlag = false;

    // * List of required fields in the form. *
    let requiredFields = ["fullname", "phone", "email"];
    for (let i = 0; i < requiredFields.length; i++) {
        let textField = document.getElementById(requiredFields[i]);
        if (textField.value == null || textField.value.trim() === "") {
            document.getElementById(requiredFields[i] + "_error").style.display = "block";
            errorFlag = true; // ! Set the error flag to true. !
        }
    }

    // * Validate the email field using a regular expression. *
    let emailField = document.getElementById("email");
    if (!validateEmail(emailField.value.trim()) && emailField.value.trim() !== "") {
        document.getElementById("email_error2").style.display = "block";
        errorFlag = true;
    }
    // * Validate the phone field using a regular expression. *
    let phoneField = document.getElementById("phone");
    if (!validatePhone(phoneField.value.trim()) && phoneField.value.trim() !== "") {
        document.getElementById("phone_error2").style.display = "block";
        errorFlag = true;
    }

    return errorFlag;
}
// * This function hides all error messages to provide a clean slate before validating the form. *
function hideAllErrors() {
    let errorItems = document.querySelectorAll(".error");
    errorItems.forEach((errorItem) => {
        errorItem.style.display = "none";
    });
}

// * This function checks if the email entered is valid using a standard email format. *
function validateEmail(email) {
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailRegex.test(email);// ! Return true if the email is valid, false otherwise. !
}

// * This function checks if the phone number entered matches the required format. *
function validatePhone(phone) {
    let phoneRegex = /^[0-9]{9}$/; // !Matches exactly 9 digits!
    return phoneRegex.test(phone);// ! Return true if the phone number is valid, false otherwise. !
}

// * This function resets the form fields and clears all error messages
function resetText() {
    hideAllErrors(); // !Clear errors on reset!
    let formFields = document.querySelectorAll("#contactForm input, #contactForm textarea");
    formFields.forEach((field) => {
        field.value = ""; // !Clear all input fields!
    });
}

// * This function sets up event listeners when the page has fully loaded. *
function load() {
    let form = document.getElementById("contactForm");
    form.addEventListener("submit", validate);

    let reset = document.querySelector(".resetbutton");
    reset.addEventListener("click", (e) => {
        e.preventDefault(); // !Prevent default reset action!
        resetText(); // !Call the resetText function to clear the form. !
    });
}
// ! Add an event listener to run the load function once the page content has loaded. !
document.addEventListener("DOMContentLoaded", load);
