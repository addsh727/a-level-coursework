// Register Validation - Initialise variables
const registerForm              = document.getElementById("register");
const registerFirstName         = document.getElementById("registerFirstName");
const registerSurname           = document.getElementById("registerSurname");
const registerEmail             = document.getElementById("registerEmail");
const registerPassword          = document.getElementById("registerPassword");

registerForm.addEventListener('submit', (e) => { // Listen for form submit event
    const registerFormValid = validateRegister();
    if(!registerFormValid){ e.preventDefault(); }
});

function validateRegister(){ // Validate function
    // Initialise variables
    const registerFirstNameVal = registerFirstName.value.trim();
    const registerSurnameVal = registerSurname.value.trim();
    const registerEmailVal = registerEmail.value.trim();
    const registerPasswordVal = registerPassword.value.trim();
    let registerFormError = false;

    if(registerFirstNameVal === ''){ // Validations
        // Set Error Message
        setErrorMessageRegister(registerFirstName, "Please enter your name.");
        registerFormError = true;
    } else{ setSuccessMessageRegister(registerFirstName); }
    if(registerSurnameVal === ''){
        // Set Error Message
        setErrorMessageRegister(registerSurname, "Please enter your surname.");
        registerFormError = true;
    }
    else{ setSuccessMessageRegister(registerSurname); }
    if(registerEmailVal === ''){
        setErrorMessageRegister(registerEmail, "Please enter an email address.");
        registerFormError = true;
    }
    else if(!validEmailRegister(registerEmailVal)){
        setErrorMessageRegister(registerEmail, "Please enter a valid email address.");
        registerFormError = true;
    }
    else{ setSuccessMessageRegister(registerEmail); }
    if(registerPasswordVal === ''){
        setErrorMessageRegister(registerPassword, "PPlease enter a password for your account.");
        registerFormError = true;
    }
    else if(registerPasswordVal.length < 8){
        setErrorMessageRegister(registerPassword, "Password must be at least 8 characters long.");
        registerFormError = true;
    }
    else{ setSuccessMessageRegister(registerPassword); } return !registerFormError;
}
function setErrorMessageRegister(element, message){ // Error Messages
    // Get Parent Element of Error Message to be set
    const registerInputBox = element.parentElement;
    const registerErrorDisplay = registerInputBox.querySelector('.formError');
    registerErrorDisplay.innerText = message; // Attach message
}
function setSuccessMessageRegister(element){ // Success Message
    // Get Parent Element of Error Message to be set
    const registerInputBox = element.parentElement;
    const registerSuccessDisplay = registerInputBox.querySelector('.formError');
    registerSuccessDisplay.innerText = ''; // Clear message
}
function validEmailRegister(email){
    // Validation with RegEx
    const reRegister = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return reRegister.test(String(email).toLowerCase());
}