const burger = document.querySelector(".burger");
const nav = document.querySelector(".nav_links");
const navLinks = document.querySelectorAll(".nav_links li");

//要素取得確認
//console.log(navLinks);

burger.addEventListener("click", () => {
    nav.classList.toggle("nav_active");

    navLinks.forEach((link, index) => {
        //要素取得確認
        //console.log(index);

        if(link.style.animation) {
            link.style.animation = "";
        } else {
            link.style.animation = `navLinksFade 0.5s ease forwards ${index / 7 + 0.4}s`;
        } 
    });

    burger.classList.toggle("toggle");
});