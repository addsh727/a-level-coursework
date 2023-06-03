// Register Validation - Initialise variables
const form                                  = document.getElementById("reset");
const Password                              = document.getElementById("changePassword");
const confirmPassword                       = document.getElementById("changeConfirm");

form.addEventListener('submit', (e) => { // Listen for form submit event
    const formValid                         = validate();
    if(!formValid){ e.preventDefault(); }
});
function validate(){ // Validate Function
    // Initialise variables
    const passwordVal                       = Password.value.trim();
    const confirmVal                        = confirmPassword.value.trim();
    let formError                           = false;

    if(passwordVal === ''){ // Validations
        setErrorMessage(Password, "Password must be at least 8 characters long.");
        formError                           = true;
    } else if(passwordVal.length < 8){
        setErrorMessage(Password, "Password must be at least 8 characters long.");
        formError                           = true;
    } else{ setSuccessMessage(Password); }
    if(confirmVal === ''){
        setErrorMessage(confirmPassword, "Password must be at least 8 characters long.");
        formError                           = true;
    } else if(confirmVal.length < 8){
        setErrorMessage(confirmPassword, "Password must be at least 8 characters long.");
        formError                           = true;
    } else{ setSuccessMessage(confirmPassword); }
    if(passwordVal !== confirmVal){
        setErrorMessage(Password, "Password must be the same.");
        setErrorMessage(confirmPassword, "Password must be the same.");
        formError                           = true;
    } return !formError;
}
function setErrorMessage(element, message){ // Error Messages
    // Get Parent Element of Error Message to be set
    const inputBox                          = element.parentElement;
    const errorDisplay                      = inputBox.querySelector('.formError');
    errorDisplay.innerText                  = message; // Attach message
}
function setSuccessMessage(element){ // Success Message
    // Get Parent Element of Error Message to be set
    const inputBox                          = element.parentElement;
    const successDisplay                    = inputBox.querySelector('.formError');
    successDisplay.innerText                = ''; // Clear message
}