// Toggle Menu - Initialise menu variables
var MenuItems = document.getElementById("MenuItems");
MenuItems.style.maxHeight = "0px";

function ToggleMenu(){ // Toggle menu when menu icon pressed
    if(MenuItems.style.maxHeight == "0px"){
        MenuItems.style.maxHeight = "400px";
    } else{ MenuItems.style.maxHeight = "0px"; }
}