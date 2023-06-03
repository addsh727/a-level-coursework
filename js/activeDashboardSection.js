// Retrieve & initialise admin panel sections & redirects
let section             = document.querySelectorAll('section');
let links               = document.querySelectorAll('ul li a');

// Get active section within viewport
window.onscroll = () =>{
    section.forEach(sec => {
        let top         = window.scrollY;
        let offset      = sec.offsetTop - 500;
        let height      = sec.offsetHeight;
        let id          = sec.getAttribute('id');
        if(top >= offset && top < offset + height){
            links.forEach(redirects =>{
                redirects.classList.remove('active');
                document.querySelector('ul li a[href*=' + id + ']').classList.add('active')
            });
        };
    });
};