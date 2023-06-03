ScrollReveal({ // ScrollReveal Configuration
    distance: '50px',
    duration: 1000
});

// All ScrollReveal functions on Fade for different elements in admin interface
ScrollReveal().reveal('.cardItem', { delay: 300, origin: 'top', interval: 200, reset: true });
ScrollReveal().reveal('.cardHeader', { delay: 500, origin: 'top', interval: 300, reset: true });
ScrollReveal().reveal('.cardBody', { delay: 600, origin: 'bottom', interval: 150, reset: true });
ScrollReveal().reveal('.entityEditBox', { delay: 600, origin: 'bottom', interval: 150, reset: true });
ScrollReveal().reveal('.text', { delay: 400, origin: 'left', reset: true });
ScrollReveal().reveal('.home-section', { delay: 100, origin: 'left', reset: true });
ScrollReveal().reveal('.tableHeader', { delay: 1000, origin: 'top', interval: 100, reset: true });
ScrollReveal().reveal('.note', { delay: 300, origin: 'top', interval: 100, reset: true });
ScrollReveal().reveal('.addNoteBox', { delay: 200, origin: 'top', interval: 100, reset: true });
ScrollReveal().reveal('.addTestimonial', { delay: 400, origin: 'right', reset: true });