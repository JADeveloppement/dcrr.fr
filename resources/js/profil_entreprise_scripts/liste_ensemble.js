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

    const addensemble_ff = document.querySelector("#addensemble_ff");

    addensemble_ff.value == 0 ? addensemble_ff.classList.add("is-invalid") : addensemble_ff.classList.remove("is-invalid");
    modele_to_add == 0 ? addensemble_select.classList.add("is-invalid") : addensemble_select.classList.remove("is-invalid");
    field_addensemble_annee.value.length == 0 ? field_addensemble_annee.classList.add('is-invalid') : field_addensemble_annee.classList.remove("is-invalid");
    field_addensemble_numerodeserie.value.length == 0 ? field_addensemble_numerodeserie.classList.add('is-invalid') : field_addensemble_numerodeserie.classList.remove("is-invalid");
    
    if (!addensemble_select.classList.contains("is-invalid") 
    && !field_addensemble_annee.classList.contains("is-invalid")
    && !field_addensemble_numerodeserie.classList.contains("is-invalid")
    && !addensemble_ff.classList.contains("is-invalid")){
        btn_save_addensemble.setAttribute("disabled", true);
        const last_text = btn_save_addensemble.innerHTML;
        btn_save_addensemble.innerHTML = loading_spinner;

        const addensemble_fieldpmaxhp = document.querySelector("#addensemble_fieldpmaxhp");
        const addensemble_fieldpminhp = document.querySelector("#addensemble_fieldpminhp");
        const addensemble_fieldpmaxmp = document.querySelector("#addensemble_fieldpmaxmp");
        const addensemble_fieldpminmp = document.querySelector("#addensemble_fieldpminmp");
        const addensemble_fieldpmaxbp = document.querySelector("#addensemble_fieldpmaxbp");
        const addensemble_fieldpminbp = document.querySelector("#addensemble_fieldpminbp");
        const addensemble_fieldtmaxhp = document.querySelector("#addensemble_fieldtmaxhp");
        const addensemble_fieldtminhp = document.querySelector("#addensemble_fieldtminhp");
        const addensemble_fieldtmaxmp = document.querySelector("#addensemble_fieldtmaxmp");
        const addensemble_fieldtminmp = document.querySelector("#addensemble_fieldtminmp");
        const addensemble_fieldtmaxbp = document.querySelector("#addensemble_fieldtmaxbp");
        const addensemble_fieldtminbp = document.querySelector("#addensemble_fieldtminbp");
        const addensemble_designationclient = document.querySelector("#addensemble_designationclient");

        const field_addensemble_datevi = document.querySelector("#field_addensemble_datevi");
        const datevi = field_addensemble_datevi.value;
        
        const ff = addensemble_ff.value;
        
        const data = {
            _token: _token,
            user_parent: user_parent,
            site_parent: site_parent,
            modele_parent: modele_parent,
            modele_to_add: modele_to_add,
            annee: field_addensemble_annee.value, 
            numerodeserie: field_addensemble_numerodeserie.value,
            pmaxhp: addensemble_fieldpmaxhp.value,
            pminhp: addensemble_fieldpminhp.value,
            pmaxmp: addensemble_fieldpmaxmp.value,
            pminmp: addensemble_fieldpminmp.value,
            pmaxbp: addensemble_fieldpmaxbp.value,
            pminbp: addensemble_fieldpminbp.value,
            tmaxhp: addensemble_fieldtmaxhp.value,
            tminhp: addensemble_fieldtminhp.value,
            tmaxmp: addensemble_fieldtmaxmp.value,
            tminmp: addensemble_fieldtminmp.value,
            tmaxbp: addensemble_fieldtmaxbp.value,
            tminbp: addensemble_fieldtminbp.value,
            ff: ff,
            datevi: datevi,
            designation_client: addensemble_designationclient.value
        };

        console.log("DATA : ", data);

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