// Listen for scroll event on website
window.addEventListener("scroll", function(){
    var header = document.getElementById("navbar");

    // Stick navigation to top after specific scroll offset & toggle class
    header.classList.toggle("ontop", window.scrollY > 100);
})