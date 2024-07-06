//ScrollReveal(about_page.html)
ScrollReveal({ 
    reset: true, 
    distance: "50px", 
    duration: 2000 
});

ScrollReveal().reveal('.page-title', { delay: 500, origin: "left" });
ScrollReveal().reveal('.topic-img', { delay: 500, origin: "bottom" });
ScrollReveal().reveal('.topic-text h2', { delay: 500, origin: "right" });
ScrollReveal().reveal('.topic-text li', { delay: 500, origin: "right", interval: 600 });