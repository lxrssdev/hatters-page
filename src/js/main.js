// Header ocultable al hacer scroll
let lastScrollTop = 0;
const header = document.getElementById('mainHeader');

window.addEventListener('scroll', function() {
    let st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop){
        // Scroll hacia abajo
        header.style.top = "-80px";
    } else {
        // Scroll hacia arriba
        header.style.top = "0";
    }
    lastScrollTop = st <= 0 ? 0 : st;
}, false);
