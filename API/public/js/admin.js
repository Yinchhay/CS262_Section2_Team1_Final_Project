document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-link');
    const subNavLinks = document.querySelectorAll('.nav-link.sub-item');

    function setActiveLink() {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
        subNavLinks.forEach(link => {
            link.classList.remove('active', 'bg-purple');
        });

        this.classList.add('active');

        if (this.classList.contains('sub-item')) {
            this.classList.add('bg-purple');
        }
    }

    navLinks.forEach(link => {
        link.addEventListener('click', setActiveLink);
    });

    subNavLinks.forEach(link => {
        link.addEventListener('click', setActiveLink);
    });

    let linkMatched = false;

    navLinks.forEach(link => {
        link.addEventListener('click', setActiveLink);

        if (link.href === window.location.href) {
            link.classList.add('active');
            if (link.classList.contains('sub-item')) {
                link.classList.add('bg-purple');
            }
            linkMatched = true;
        }
    });

    if (!linkMatched && !window.location.pathname.endsWith('/')) {
        const currentURLWithSlash = window.location.href + '/';
        navLinks.forEach(link => {
            if (link.href === currentURLWithSlash) {
                link.classList.add('active');
                if (link.classList.contains('sub-item')) {
                    link.classList.add('bg-purple');
                }
            }
        });
    }

    const body = document.querySelector('body');
    const sidebar = body.querySelector('.sidebar');
    const toggle = body.querySelector('.toggle');
    console.log(toggle);

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('close');
    });
});
