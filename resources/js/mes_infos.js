import {fetch_result, toggleButtonClick, do_popup} from "./utils.js";

const _token = document.querySelector("meta[name='_token']").getAttribute("content");

const popup_save_infos_container = document.querySelector(".saveinfos-container");
// stashing
const btn_save_infos = document.querySelector(".save-mesinfos-infos");
const btn_save_infospasword = document.querySelector(".save-mesinfos-password");
const popup_save_infos = document.querySelector(".saveinfos-container");

const btn_save_mesinfos = document.querySelector(".btn-save-mesinfos");

const field_mesinfos_name = document.querySelector("#field_mesinfos_name");
const field_mesinfos_email = document.querySelector("#field_mesinfos_email");
const field_mesinfos_entreprise = document.querySelector("#field_mesinfos_entreprise");
const field_mesinfos_poste = document.querySelector("#field_mesinfos_poste");
const field_mesinfos_newsletter = document.querySelector("#field_mesinfos_newsletter");
const field_mesinfos_password = document.querySelector("#field_mesinfos_password");

const field_mesinfos_oldpassword = document.querySelector("#field_mesinfos_oldpassword");
const field_mesinfos_newpassword = document.querySelector("#field_mesinfos_newpassword");
const field_mesinfos_confirmpassword = document.querySelector("#field_mesinfos_confirmpassword");

btn_save_infos.addEventListener("click", function(){
    popup_save_infos.style.top = 0;
    btn_save_mesinfos.setAttribute("data-target", "mesinfos")
})

btn_save_infospasword.addEventListener("click", function(){
    popup_save_infos.style.top = 0;
    btn_save_mesinfos.setAttribute("data-target", "infospwd")
})

btn_save_mesinfos.addEventListener("click", async function(){
    const target = this.getAttribute("data-target");

    if (target == "mesinfos"){
        const password = field_mesinfos_password.value;
        const name = field_mesinfos_name.value;
        const email = field_mesinfos_email.value;
        const entreprise = field_mesinfos_entreprise.value;
        const poste = field_mesinfos_poste.value;
        const newsletter = field_mesinfos_newsletter.checked;

        field_mesinfos_name.value.length == 0 ? field_mesinfos_name.classList.add("is-invalid") : field_mesinfos_name.classList.remove("is-invalid");
        field_mesinfos_email.value.length == 0 ? field_mesinfos_email.classList.add("is-invalid") : field_mesinfos_email.classList.remove("is-invalid");
        field_mesinfos_entreprise.value.length == 0 ? field_mesinfos_entreprise.classList.add("is-invalid") : field_mesinfos_entreprise.classList.remove("is-invalid");
        field_mesinfos_poste.value.length == 0 ? field_mesinfos_poste.classList.add("is-invalid") : field_mesinfos_poste.classList.remove("is-invalid");
        
        if (!field_mesinfos_name.classList.contains("is-invalid") && !field_mesinfos_email.classList.contains("is-invalid") && !field_mesinfos_entreprise.classList.contains("is-invalid") && !field_mesinfos_poste.classList.contains("is-invalid")){
            const data = {
                _token: _token,
                password: password,
                name: name,
                email: email,
                entreprise: entreprise,
                poste: poste,
                newsletter: newsletter ? 1 : 0,
            }

            try {
                const result = await fetch_result("/save_mesinfos", data);
                if (parseInt(result.r) == -1)
                    do_popup("bg-red-600", "bi-x-circle", "Mauvais mot de passe");
                else if (parseInt(result.r) == 1){
                    do_popup("bg-dcrr-green", "bi-check-circle", "Informations correctement enregistrées.");
                }
                console.log(result);
            } catch(error){
                do_popup("bg-red-600", "bi-x-circle", "Une erreur est survenue : "+error);
            }
        } else {
            do_popup("bg-orange-600", "bi-info-circle", "Veuillez remplir les informations nécessaires");
        }
    } else if (target == "infospwd"){
        const oldpassword = field_mesinfos_oldpassword.value;
        const newpassword = field_mesinfos_newpassword.value;
        const confirmpassword = field_mesinfos_confirmpassword.value;

        field_mesinfos_oldpassword.value.length == 0 ? field_mesinfos_oldpassword.classList.add("is-invalid") : field_mesinfos_oldpassword.classList.remove("is-invalid");
        field_mesinfos_newpassword.value.length == 0 ? field_mesinfos_newpassword.classList.add("is-invalid") : field_mesinfos_newpassword.classList.remove("is-invalid");
        field_mesinfos_confirmpassword.value.length == 0 ? field_mesinfos_confirmpassword.classList.add("is-invalid") : field_mesinfos_confirmpassword.classList.remove("is-invalid");

        if (!field_mesinfos_newpassword.classList.contains("is-invalid") && !field_mesinfos_confirmpassword.classList.contains("is-invalid")){
            if (confirmpassword == newpassword){
                const data = {
                    _token: _token,
                    password: field_mesinfos_password.value,
                    oldpassword: oldpassword,
                    newpassword: newpassword
                };
    
                const result = await fetch_result("/savepwd", data);
                if (result.r == -1) 
                    do_popup("bg-red-600", "bi-x-circle", "Mauvais ancien mot de passe.");
                else if (result.r == 1){
                    do_popup("bg-dcrr-green", "bi-info-circle", "Mot de passe modifié avec succès.");
                }
            } else {
                do_popup("bg-red-600", "bi-x-circle", "Mauvaise confirmation de mot de passe.");
            }
        } else {
            do_popup("bg-orange-600", "bi-info-circle", "Veuillez remplir toutes les informations svp");
        }
    }
    field_mesinfos_password.value = "";
    popup_save_infos_container.style.top = "-100vh";
})