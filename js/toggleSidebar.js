// Toggle Sidebar - Initialise variables
const sidebar = document.querySelector(".sidebar");
const closeBtn = document.getElementById("btn");

// Listen for close button click event
closeBtn.addEventListener("click", ()=>{ // when collapsing
    sidebar.classList.toggle("open");
    menuBtnChange();    // calling the function below
});
function menuBtnChange() { // change sidebar button
    if(sidebar.classList.contains("open")){
        closeBtn.innerHTML= "arrow_back_ios";   //replace icon class
    } else{
        closeBtn.innerHTML = "menu";    //replace icon class
    }
}