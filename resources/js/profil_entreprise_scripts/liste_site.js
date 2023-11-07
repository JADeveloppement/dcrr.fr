import {fetch_result, toggleButtonClick, do_popup} from "./../utils.js";

const _token = document.querySelector("meta[name='_token']").getAttribute("content");

const add_site = document.querySelector(".add-site");
const popup_add_site = document.querySelector(".popup-addsite");

add_site.addEventListener("click", function(){
    popup_add_site.style.top = "0";
})

const row_site = document.querySelectorAll("tr[data-target='site']");
const row_site_action = document.querySelectorAll(".site-action");

row_site_action.forEach((t) => {
    t.addEventListener("click", function(){
        const id = this.getAttribute("data-id");
        const action = this.getAttribute("data-toggle");

        if (action == "delete"){
            console.log("delete");
        } else if (action == "edit"){
            console.log("edit");
        }
    })
})
row_site.forEach((t) =>  {
    t.addEventListener("click", function(e){
        const urlParams = new URLSearchParams(window.location.search);
        const params = {};

        urlParams.forEach((value, key) => {
            params[key] = value;
        });

        const id = this.getAttribute("data-site");
        if (e.target.classList.contains("site-action")) e.preventDefault();
        else {
            window.location="?displayMenu=1&userId="+params.userId+"&displaySite="+id;
        } 
    })
})

const btn_save_addsite = document.querySelector(".btn-save-addsite");

btn_save_addsite.addEventListener("click", async function(){
    const id = this.getAttribute("data-target");
    const field_addsite_nomclient = document.querySelector("#field_addsite_nomclient");
    const field_addsite_codeclient = document.querySelector("#field_addsite_codeclient");
    const field_addsite_nomsite = document.querySelector("#field_addsite_nomsite");
    const field_addsite_codesite = document.querySelector("#field_addsite_codesite");
    // const field_addsite_date_mise_en_service = document.querySelector("#field_addsite_date_mise_en_service");
    // const field_addsite_designation = document.querySelector("#field_addsite_designation");
    // const field_addsite_conforme = document.querySelector("#field_addsite_conforme");
    // const field_addsite_marque = document.querySelector("#field_addsite_marque");
    // const field_addsite_fluide = document.querySelector("#field_addsite_fluide");

    field_addsite_nomclient.value.length < 3 ? field_addsite_nomclient.classList.add("is-invalid") : field_addsite_nomclient.classList.remove("is-invalid")
    field_addsite_codeclient.value.length == 0 ? field_addsite_codeclient.classList.add("is-invalid") : field_addsite_codeclient.classList.remove("is-invalid")
    field_addsite_nomsite.value.length < 3 ? field_addsite_nomsite.classList.add("is-invalid") : field_addsite_nomsite.classList.remove("is-invalid")
    field_addsite_codesite.value.length == 0 ? field_addsite_codesite.classList.add("is-invalid") : field_addsite_codesite.classList.remove("is-invalid")
    // field_addsite_date_mise_en_service.value.length < 3 ? field_addsite_date_mise_en_service.classList.add("is-invalid") : field_addsite_date_mise_en_service.classList.remove("is-invalid")
    // field_addsite_designation.value.length < 3 ? field_addsite_designation.classList.add("is-invalid") : field_addsite_designation.classList.remove("is-invalid")
    // field_addsite_marque.value == 0 ? field_addsite_marque.classList.add("is-invalid") : field_addsite_marque.classList.remove("is-invalid") ;
    // field_addsite_fluide.value == 0 ? field_addsite_fluide.classList.add("is-invalid") : field_addsite_fluide.classList.remove("is-invalid") ;

    // if (!field_addsite_nomclient.classList.contains("is-invalid") && !field_addsite_codeclient.classList.contains("is-invalid") && !field_addsite_nomsite.classList.contains("is-invalid") && !field_addsite_codesite.classList.contains("is-invalid") && !field_addsite_date_mise_en_service.classList.contains("is-invalid") && !field_addsite_designation.classList.contains("is-invalid") && !field_addsite_marque.classList.contains("is-invalid") && !field_addsite_fluide.classList.contains("is-invalid")){
    if (!field_addsite_nomclient.classList.contains("is-invalid") && !field_addsite_codeclient.classList.contains("is-invalid") && !field_addsite_nomsite.classList.contains("is-invalid") && !field_addsite_codesite.classList.contains("is-invalid")){
        const data = {
            _token: _token,
            id: id,
            code_client : field_addsite_codeclient.value,
            nom_client : field_addsite_nomclient.value,
            nom_site : field_addsite_nomsite.value,
            code_site : field_addsite_codesite.value,
            // fluide_frigorigène : field_addsite_fluide.value,
            // date_mise_en_service : field_addsite_date_mise_en_service.value,
            // marque : field_addsite_marque.value,
            // designation_equipement : field_addsite_designation.value,
        }

        console.log(data);
        
        try {
            const result = await fetch_result("/add_site", data);
            do_popup("bg-dcrr-green", "bi-info", "Site rajouté avec succès, la page va se rafraichir");
            popup_add_site.style.top = "-100vh";
            setTimeout(function(){
                location.reload(true)
            }, 2000);
        } catch(error){
            console.log(e);
        }
    } else {
        do_popup("bg-red-600", "bi-x-octagon", "Veuillez compléter les champs obligatoires");
    }

})