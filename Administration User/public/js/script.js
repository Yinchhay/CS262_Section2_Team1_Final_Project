document.addEventListener("DOMContentLoaded", function () {
    var navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(function (navLink) {
        navLink.addEventListener("click", function (event) {
            navLinks.forEach(function (link) {
                link.classList.remove("active");
            });

            navLink.classList.add("active");
        });
    });

    window.addEventListener("scroll", function () {
        document.querySelectorAll("section").forEach(function (section) {
            var sectionTop = section.offsetTop;
            var sectionBottom = section.offsetTop + section.offsetHeight;

            if (window.scrollY >= sectionTop && window.scrollY < sectionBottom) {
                var sectionId = section.getAttribute("id");

                navLinks.forEach(function (link) {
                    link.classList.remove("active");

                    if (link.getAttribute("href") === "#" + sectionId) {
                        link.classList.add("active");
                    }
                });
            }
        });
    });

    const loginLink = document.getElementById('loginLink');
    const signupLink = document.getElementById('signupLink');

    loginLink.querySelector('button').addEventListener('click', function() {
        loginLink.classList.add('underline-disabled');
    });

    signupLink.querySelector('button').addEventListener('click', function() {
        signupLink.classList.add('underline-disabled');
    });

});

document.querySelector('a[href="#signup"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('login').style.display = 'none';
    document.getElementById('signup').style.display = 'block';
});

document.querySelector('a[href="#login"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('signup').style.display = 'none';
    document.getElementById('login').style.display = 'block';
});

document.querySelector('a[href="/authentication#signup"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('login').style.display = 'none';
    document.getElementById('signup').style.display = 'block';
});

document.querySelector('a[href="/authentication#login"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('signup').style.display = 'none';
    document.getElementById('login').style.display = 'block';
});
