import {fetch_result, toggleButtonClick, do_popup} from "./../utils.js";
const _token = document.querySelector("meta[name='_token']").getAttribute("content");

const actionuser_role = ["NC", "Client", "Employé", "Administrateur"];
const span_check = "<span class='text-[1.5rem] bi bi-check text-dcrr-green'></span>";
const span_x = "<span class='text-[1.5rem] bi bi-x text-red-600'></span>";
const span_loading = "<span class='spinner spinner-border text-secondary'></span>"

const btn_accept_actionuser = document.querySelectorAll(".action-accept-actionuser");
const btn_delete_actionuser = document.querySelectorAll(".action-delete-actionuser");

const row_action_user = document.querySelectorAll("tr[data-toggle='action-user']");
const popup_detailaction_container = document.querySelector(".detail-useraction-container");
const detail_user_action_nomprenom = document.querySelector(".detail_user_action_nomprenom");
const detail_user_action_email = document.querySelector(".detail_user_action_email");
const detail_user_action_telephone = document.querySelector(".detail_user_action_telephone");
const detail_user_action_entreprise = document.querySelector(".detail_user_action_entreprise");
const detail_user_action_poste = document.querySelector(".detail_user_action_poste");
const detail_user_action_newsletter = document.querySelector(".detail_user_action_newsletter");
const detail_user_action_role = document.querySelector(".detail_user_action_role");
const detail_user_action_active = document.querySelector(".detail_user_action_active");
const detail_user_action_createdAt = document.querySelector(".detail_user_action_createdAt");

const detail_user_action_nomprenom_mod = document.querySelector(".detail_user_action_nomprenom_mod");
const detail_user_action_email_mod = document.querySelector(".detail_user_action_email_mod");
const detail_user_action_telephone_mod = document.querySelector(".detail_user_action_telephone_mod");
const detail_user_action_entreprise_mod = document.querySelector(".detail_user_action_entreprise_mod");
const detail_user_action_poste_mod = document.querySelector(".detail_user_action_poste_mod");
const detail_user_action_newsletter_mod = document.querySelector(".detail_user_action_newsletter_mod");
const detail_user_action_role_mod = document.querySelector(".detail_user_action_role_mod");
const detail_user_action_active_mod = document.querySelector(".detail_user_action_active_mod");
const detail_user_action_createdAt_mod = document.querySelector(".detail_user_action_createdAt_mod");

/**
 * Checks for differences between user details and modifies the font if there is a difference.
 *
 * @param {} 
 * @return {}
 */
function action_user_check_diff(){
    detail_user_action_nomprenom.innerHTML != detail_user_action_nomprenom_mod.innerHTML ? detail_user_action_nomprenom_mod.classList.add("font-extrabold") : detail_user_action_nomprenom_mod.classList.remove("font-extrabold")
    detail_user_action_email.innerHTML != detail_user_action_email_mod.innerHTML ? detail_user_action_email_mod.classList.add("font-extrabold") : detail_user_action_email_mod.classList.remove("font-extrabold")
    detail_user_action_telephone.innerHTML != detail_user_action_telephone_mod.innerHTML ? detail_user_action_telephone_mod.classList.add("font-extrabold") : detail_user_action_telephone_mod.classList.remove("font-extrabold")
    detail_user_action_entreprise.innerHTML != detail_user_action_entreprise_mod.innerHTML ? detail_user_action_entreprise_mod.classList.add("font-extrabold") : detail_user_action_entreprise_mod.classList.remove("font-extrabold")
    detail_user_action_poste.innerHTML != detail_user_action_poste_mod.innerHTML ? detail_user_action_poste_mod.classList.add("font-extrabold") : detail_user_action_poste_mod.classList.remove("font-extrabold")
    detail_user_action_newsletter.innerHTML != detail_user_action_newsletter_mod.innerHTML ? detail_user_action_newsletter_mod.classList.add("font-extrabold") : detail_user_action_newsletter_mod.classList.remove("font-extrabold")
    detail_user_action_role.innerHTML != detail_user_action_role_mod.innerHTML ? detail_user_action_role_mod.classList.add("font-extrabold") : detail_user_action_role_mod.classList.remove("font-extrabold")
    detail_user_action_active.innerHTML != detail_user_action_active_mod.innerHTML ? detail_user_action_active_mod.classList.add("font-extrabold") : detail_user_action_active_mod.classList.remove("font-extrabold")
}

row_action_user.forEach((t) => {
    t.addEventListener("click", async function(e){
        if (e.target.classList.contains("action-accept-actionuser") || e.target.classList.contains("action-delete-actionuser")) e.preventDefault();
        else {
            const id = this.getAttribute("data-id");
            const from = this.getAttribute("data-table");
            popup_detailaction_container.style.top = "0";
            detail_user_action_nomprenom.innerHTML = span_loading;
            detail_user_action_email.innerHTML = span_loading;
            detail_user_action_telephone.innerHTML = span_loading;
            detail_user_action_entreprise.innerHTML = span_loading;
            detail_user_action_poste.innerHTML = span_loading;
            detail_user_action_newsletter.innerHTML = span_loading;
            detail_user_action_role.innerHTML = span_loading;
            detail_user_action_active.innerHTML = span_loading;
            detail_user_action_createdAt.innerHTML = span_loading;

            detail_user_action_nomprenom_mod.innerHTML = span_loading;
            detail_user_action_email_mod.innerHTML = span_loading;
            detail_user_action_telephone_mod.innerHTML = span_loading;
            detail_user_action_entreprise_mod.innerHTML = span_loading;
            detail_user_action_poste_mod.innerHTML = span_loading;
            detail_user_action_newsletter_mod.innerHTML = span_loading;
            detail_user_action_role_mod.innerHTML = span_loading;
            detail_user_action_active_mod.innerHTML = span_loading;
            detail_user_action_createdAt_mod.innerHTML = span_loading;

            try {
                const result = await fetch_result("/get_user", {
                    _token: _token,
                    id: id,
                    table: from
                });
                detail_user_action_nomprenom.innerHTML = result.r.nomprenom;
                detail_user_action_email.innerHTML = result.r.email;
                detail_user_action_telephone.innerHTML = result.r.telephone;
                detail_user_action_entreprise.innerHTML = result.r.entreprise;
                detail_user_action_poste.innerHTML = result.r.poste;
                detail_user_action_newsletter.innerHTML = result.r.newsletter ? span_check : span_x;
                detail_user_action_role.innerHTML = actionuser_role[result.r.role];
                detail_user_action_active.innerHTML = result.r.active ? span_check : span_x;
                detail_user_action_createdAt.innerHTML = result.r.createdAt;

                if (result.action == 1){
                    detail_user_action_nomprenom_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_email_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_telephone_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_entreprise_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_poste_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_newsletter_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_role_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_active_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                    detail_user_action_createdAt_mod.innerHTML = "<span class='badge bg-warning'>Ajout</span>"
                } else if(result.action == 2){
                    detail_user_action_nomprenom_mod.innerHTML = result.origin.nomprenom;
                    detail_user_action_email_mod.innerHTML = result.origin.email;
                    detail_user_action_telephone_mod.innerHTML = result.origin.telephone;
                    detail_user_action_entreprise_mod.innerHTML = result.origin.entreprise;
                    detail_user_action_poste_mod.innerHTML = result.origin.poste;
                    detail_user_action_newsletter_mod.innerHTML = result.origin.newsletter ? span_check : span_x
                    detail_user_action_role_mod.innerHTML = actionuser_role[result.origin.role];
                    detail_user_action_active_mod.innerHTML = result.origin.active ? span_check : span_x;
                    detail_user_action_createdAt_mod.innerHTML = result.origin.createdAt;

                    action_user_check_diff();
                }
            } catch(error) {
                do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
            }
        }
    })
})

btn_accept_actionuser.forEach((btn) => {
    btn.addEventListener("click", async function() {
        const id = this.getAttribute("data-id");
        console.log("ACTION accept :", id);

        try {
            const result = await fetch_result("activate_user", {
                _token: _token,
                id: id
            });
            if (result.r) {
                do_popup("bg-dcrr-green", "bi-info-circle", "Compte activé");
                document.querySelector("tr[data-toggle='action-user'][data-id='"+id+"']").remove();
            } else {
                do_popup("bg-red-600", "bi-x-octagon", "Une erreur s'est produite, veuillez réessayer.");
            }
        } catch (error) {
            do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
        }
    })
})

btn_delete_actionuser.forEach((btn) => {
    btn.addEventListener("click", function() {
        const id = this.getAttribute("data-id");
        console.log("ACTION delete :", id);
    })
}) 