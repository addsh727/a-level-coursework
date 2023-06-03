// Toggle Button for Login and Register - Initialise variables
let w = document.getElementById("login");
let x = document.getElementById("register");
let y = document.getElementById("btn");
let z = document.getElementById("formbox");

// When switching to Register section
function register(){
    w.style.left = "-400px";
    x.style.left = "50px";
    y.style.left = "110px";
    y.style.background = "linear-gradient(to right, #f6f6f6, #a1a1a1)";
    z.style.height = "660px";
    z.style.transition = "0.5s";
}

// When switching to Login section
function login(){
    w.style.left = "50px";
    x.style.left = "450px";
    y.style.left = "0px";
    y.style.background = "linear-gradient(to right, #a1a1a1, #f6f6f6)";
    z.style.height = "480px";
    z.style.transition = "0.5s";
}