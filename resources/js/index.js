import './bootstrap';

const loading = document.querySelector(".loading");
const logo_loading = document.querySelector(".logo-first-loading");
const barre_horizontale = document.querySelector(".barre-horizontale");
const screen_loading = document.querySelector(".screen-loading ");

window.addEventListener("DOMContentLoaded", function(){
    loading.remove();
    logo_loading.style.opacity = "1";
    setTimeout(() => {
        barre_horizontale.style.width = "100vw";
    }, 1500)

    setTimeout(() => {
        if (window.innerHeight > window.innerWidth) screen_loading.style.top = "-100vh";
        else screen_loading.style.left = "-100vw";
    }, 3500)
})