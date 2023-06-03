function toggleLoginPassword(){ // Toggle Login Password Eye
    var loginPassword = document.getElementById("loginPassword");
    var showLogin = document.getElementById("showLogin");
    var hideLogin = document.getElementById("hideLogin");
    if(loginPassword.type === "password"){
        loginPassword.type = "text";
        showLogin.style.display = "inherit";
        hideLogin.style.display = "none";
    } else{
        loginPassword.type = "password";
        showLogin.style.display = "none";
        hideLogin.style.display = "inherit";
    }
}
function toggleRegisterPassword(){ // Toggle Register Password Eye
    var registerPassword = document.getElementById("registerPassword");
    var showRegister = document.getElementById("showRegister");
    var hideRegister = document.getElementById("hideRegister");
    if(registerPassword.type === "password"){
        registerPassword.type = "text";
        showRegister.style.display = "inherit";
        hideRegister.style.display = "none";
    } else{
        registerPassword.type = "password";
        showRegister.style.display = "none";
        hideRegister.style.display = "inherit";
    }
}
function toggleChangePassword(){ // Toggle Change Password Eye
    var changePassword = document.getElementById("changePassword");
    var showChangePassword = document.getElementById("showChangePassword");
    var hideChangePassword = document.getElementById("hideChangePassword");
    if(changePassword.type === "password"){
        changePassword.type = "text";
        showChangePassword.style.display = "inherit";
        hideChangePassword.style.display = "none";
    } else{
        changePassword.type = "password";
        showChangePassword.style.display = "none";
        hideChangePassword.style.display = "inherit";
    }
}
function toggleConfirmChangePassword(){ // Toggle Confirm Change Password Eye
    var changeConfirm = document.getElementById("changeConfirm");
    var showConfirmChangePassword = document.getElementById("showConfirmChangePassword");
    var hideConfirmChangePassword = document.getElementById("hideConfirmChangePassword");
    if(changeConfirm.type === "password"){
        changeConfirm.type = "text";
        showConfirmChangePassword.style.display = "inherit";
        hideConfirmChangePassword.style.display = "none";
    } else{
        changeConfirm.type = "password";
        showConfirmChangePassword.style.display = "none";
        hideConfirmChangePassword.style.display = "inherit";
    }
}