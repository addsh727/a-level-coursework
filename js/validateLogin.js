// Register Validation - Initialise variables
const loginForm                             = document.getElementById("login");
const loginEmail                            = document.getElementById("loginEmail");
const loginPassword                         = document.getElementById("loginPassword");

loginForm.addEventListener('submit', (e) => { // Listen for form submit event
    const loginFormValid                    = validateLogin();
    if(!loginFormValid){ e.preventDefault(); }
});
function validateLogin(){ // Validate function
    // Initialise variables
    const loginEmailVal                     = loginEmail.value.trim();
    const loginPasswordVal                  = loginPassword.value.trim();
    let loginFormError                      = false;

    if(loginEmailVal === ''){ // Validations
        setErrorMessageLogin(loginEmail, "Please enter an email address.");
        loginFormError                      = true;
    } else if(!validEmailLogin(loginEmailVal)){
        setErrorMessageLogin(loginEmail, "Please enter a valid email address.");
        loginFormError                      = true;
    } else{ setSuccessMessageLogin(loginEmail); }

    if(loginPasswordVal === ''){
        setErrorMessageLogin(loginPassword, "Please enter a password to login.");
        loginFormError                      = true;
    } else if(loginPasswordVal.length < 8){
        setErrorMessageLogin(loginPassword, "Password must be at least 8 characters long.");
        loginFormError                      = true;
    } else{ setSuccessMessageLogin(loginPassword); } return !loginFormError;
}
function setErrorMessageLogin(element, message){ // Error Messages
    // Get Parent Element of Error Message to be set
    const loginInputBox                     = element.parentElement;
    const loginErrorDisplay                 = loginInputBox.querySelector('.formError');
    loginErrorDisplay.innerText             = message; // Attach message
}
function setSuccessMessageLogin(element){ // Success Message
    // Get Parent Element of Error Message to be set
    const loginInputBox                     = element.parentElement;
    const loginSuccessDisplay               = loginInputBox.querySelector('.formError');
    loginSuccessDisplay.innerText           = ''; // Clear message
}
function validEmailLogin(email){
    // Validation with RegEx
    const reLogin = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return reLogin.test(String(email).toLowerCase());
}