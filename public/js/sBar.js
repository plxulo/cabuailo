const body = document.body;
let lastScroll = 0;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset
    
    if (currentScroll > 700) {
<<<<<<< HEAD
=======
        navbar.style.background = 'var(--cor-escura)';
>>>>>>> paulo

        if (currentScroll <= 0) {
            body.classList.remove("scroll-up")
        }
        if (currentScroll > lastScroll && !body.classList.contains("scroll-down")) {
            body.classList.remove("scroll-up")
            body.classList.add("scroll-down")
        }
        if (currentScroll < lastScroll && body.classList.contains("scroll-down")) {
            body.classList.remove("scroll-down")
            body.classList.add("scroll-up")
        }

    }

<<<<<<< HEAD
=======
    else {
        navbar.style.background = 'none';
    }

>>>>>>> paulo
    lastScroll = currentScroll;
})