    document.addEventListener("DOMContentLoaded", function() {
        const navbarLinks = document.querySelectorAll(".navbar-nav .nav-link");

        navbarLinks.forEach(link => {
            link.addEventListener("click", function(event) {
                // Remove 'active' class from all navbar items
                navbarLinks.forEach(link => {
                    link.classList.remove('active');
                });

                // Add 'active' class to the clicked navbar item
                this.classList.add('active');
            });
        });
    });

