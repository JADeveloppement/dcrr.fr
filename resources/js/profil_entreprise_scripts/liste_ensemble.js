import {fetch_result, toggleButtonClick, do_popup} from "./../utils.js";
const _token = document.querySelector("meta[name='_token']").getAttribute("content");
const loading_spinner = "<span class='spinner spinner-border'></span>";

const row_ensemble = document.querySelectorAll("tr[data-toggle='ensemble']");

row_ensemble.forEach((r) => {
    r.addEventListener("click", function(e){
        const id = this.getAttribute("data-id");
        const user_parent = this.getAttribute("data-userparent");
        const site_parent = this.getAttribute("data-siteparent");
        if (e.target.classList.contains("data-action")) e.preventDefault();
        else {
            const link = "?displayMenu=1&userId="+user_parent+"&displaySite="+site_parent+"&displayEnsemble="+id;
            window.location = link;
        }
    })
})

const btn_addensemble = document.querySelector(".btn-add-ensemble");
const popup_addensemble = document.querySelector(".popup-addensemble");

btn_addensemble.addEventListener("click", function(){
    popup_addensemble.style.top = 0;
})

const btn_save_addensemble = document.querySelector(".btn-save-addensemble");
const addensemble_select = document.querySelector("#field_addensemble_ensemble");

btn_save_addensemble.addEventListener("click", async function(){
    
    const user_parent = this.getAttribute("data-userparent");
    const site_parent = this.getAttribute("data-siteparent");
    const modele_parent = this.getAttribute("data-modeleparent");
    const modele_to_add = addensemble_select.value;

    const field_addensemble_annee = document.querySelector("#field_addensemble_annee");
    const field_addensemble_numerodeserie = document.querySelector("#field_addensemble_numerodeserie");

    modele_to_add == 0 ? addensemble_select.classList.add("is-invalid") : addensemble_select.classList.remove("is-invalid");
    field_addensemble_annee.value.length == 0 ? field_addensemble_annee.classList.add('is-invalid') : field_addensemble_annee.classList.remove("is-invalid");
    field_addensemble_numerodeserie.value.length == 0 ? field_addensemble_numerodeserie.classList.add('is-invalid') : field_addensemble_numerodeserie.classList.remove("is-invalid");
    
    if (!addensemble_select.classList.contains("is-invalid") 
    && !field_addensemble_annee.classList.contains("is-invalid")
    && !field_addensemble_numerodeserie.classList.contains("is-invalid")){
        btn_save_addensemble.setAttribute("disabled", true);
        const last_text = btn_save_addensemble.innerHTML;
        btn_save_addensemble.innerHTML = loading_spinner;
        
        const data = {
            _token: _token,
            user_parent: user_parent,
            site_parent: site_parent,
            modele_parent: modele_parent,
            modele_to_add: modele_to_add,
            annee: field_addensemble_annee.value, 
            numerodeserie: field_addensemble_numerodeserie.value
        };

        try {
            const r = await fetch_result("/add_ensemble", data);
            console.log(r);
            do_popup("bg-dcrr-green", "bi-info-circle", "Ajout effectué : "+r.r);
            btn_save_addensemble.innerHTML = last_text;
            btn_save_addensemble.removeAttribute("disabled");
            popup_addensemble.style.top = "-100vh";
            location.reload(true);
        } catch (error) {
            do_popup("bg-red-600", "bi-x-octagone", "Erreur : "+error);
            console.e(error);
            popup_addensemble.style.top = "-100vh";
            btn_save_addensemble.innerHTML = last_text;
        }
    } else{
        do_popup("bg-red-600", "bi-x-octagon", "Veuillez remplir les champs obligatoires avant d'enregistrer.");
    }
})