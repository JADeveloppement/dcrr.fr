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

const btn_addensemble = document.querySelector(".btn-add-ensemble");
const popup_addensemble = document.querySelector(".popup-addensemble");

btn_addensemble.addEventListener("click", function(){
    popup_addensemble.style.top = 0;
})

const btn_save_addensemble = document.querySelector(".btn-save-addensemble");
const addensemble_select = document.querySelector("#field_addensemble_ensemble");

btn_save_addensemble.addEventListener("click", function(){
    const user_parent = this.getAttribute("data-userparent");
    if (addensemble_select.value == 0) console.log("pas bon");
    else console.log("bon");
    console.log(user_parent);
})