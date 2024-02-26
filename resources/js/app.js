import './bootstrap';

document.addEventListener("DOMContentLoaded", function() {
    const navbarLinks = document.querySelectorAll(".navbar-nav a.nav-link");
    
    navbarLinks.forEach(link => {
        link.addEventListener("click", function() {
            navbarLinks.forEach(link => {
                link.classList.remove("active");
            });
            this.classList.add("active");
        });
    });
});