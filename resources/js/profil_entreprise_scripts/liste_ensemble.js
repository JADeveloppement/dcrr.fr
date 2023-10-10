import {fetch_result, toggleButtonClick, do_popup} from "./../utils.js";
const _token = document.querySelector("meta[name='_token']").getAttribute("content");

const row_ensemble = document.querySelectorAll("tr[data-target='ensemble']");

row_ensemble.forEach((r) => {
    r.addEventListener("click", function(e){
        const urlParams = new URLSearchParams(window.location.search);
        const params = {};

        urlParams.forEach((value, key) => {
            params[key] = value;
        });

        const id = this.getAttribute("data-ensemble");
        if (e.target.classList.contains("site-action")) e.preventDefault();
        else window.location="?displayMenu=1&userId"+params.userId+"&displaySite="+params.displaySite+"&displayEnsemble="+id;
    })
})