import {fetch_result, toggleButtonClick, do_popup} from "./../utils.js";
const _token = document.querySelector("meta[name='_token']").getAttribute("content");
const loading_spinner = "<span class='spinner spinner-border'></span>";

const btn_add_modele = document.querySelector(".add-modele");
const popup_add_modele = document.querySelector(".popup-addmodele");

btn_add_modele.addEventListener("click", function(){
    popup_add_modele.style.top = "0";
})

const popup_detail_listemodele = document.querySelector(".detail-listemodele-container");
const popup_listemodele_loading = document.querySelector(".listemodele_loading")
const popup_listemodele_table = document.querySelector(".popuplistemodele-table");

const detailistemodele_type = document.querySelector(".detailistemodele_type");
const detailistemodele_nature = document.querySelector(".detailistemodele_nature");
const detailistemodele_designation = document.querySelector(".detailistemodele_designation");
const detailistemodele_reference = document.querySelector(".detailistemodele_reference");
const detailistemodele_fabricant = document.querySelector(".detailistemodele_fabricant");
const detailistemodele_volume = document.querySelector(".detailistemodele_volume");
const detailistemodele_diametrenominal = document.querySelector(".detailistemodele_diametrenominal");
const detailistemodele_pmaxc = document.querySelector(".detailistemodele_pmaxc");
const detailistemodele_pminc = document.querySelector(".detailistemodele_pminc");
const detailistemodele_pmaxr = document.querySelector(".detailistemodele_pmaxr");
const detailistemodele_pminr = document.querySelector(".detailistemodele_pminr");
const detailistemodele_ptarage = document.querySelector(".detailistemodele_ptarage");
const detailistemodele_tmaxc = document.querySelector(".detailistemodele_tmaxc");
const detailistemodele_tminc = document.querySelector(".detailistemodele_tminc");
const detailistemodele_tmaxr = document.querySelector(".detailistemodele_tmaxr");
const detailistemodele_tminr = document.querySelector(".detailistemodele_tminr");
const detailistemodele_categorieff = document.querySelector(".detailistemodele_categorieff");
const detailistemodele_catderisque = document.querySelector(".detailistemodele_catderisque");
const detailistemodele_numerodeserie = document.querySelector(".detailistemodele_numerodeserie");
const detailistemodele_annee = document.querySelector(".detailistemodele_annee");
const detailistemodele_chapitre = document.querySelector(".detailistemodele_chapitre");
const detailistemodele_periodiciteinspection = document.querySelector(".detailistemodele_periodiciteinspection");

const td_listemodele = document.querySelectorAll("tr[data-toggle='listemodele']");
td_listemodele.forEach((item) => {
    item.addEventListener("click", async function(e){
        const id = this.getAttribute("data-id");
        if (e.target.getAttribute('data-toggle') !== "actionlistemodele"){
            popup_detail_listemodele.style.top = 0;

            const data = {
                _token: _token,
                id: id
            }

            const result = await fetch_result("/get_modele_data_detail", data);
            popup_listemodele_loading.classList.add("hidden");
            popup_listemodele_table.classList.remove("hidden");

            console.log(result);

            detailistemodele_type.innerText = result.type
            detailistemodele_nature.innerText = result.nature
            detailistemodele_designation.innerText = result.designation
            detailistemodele_reference.innerText = result.complement_reference
            detailistemodele_fabricant.innerText = result.fabricant

            result.volume ? detailistemodele_volume.innerText = result.volume : detailistemodele_volume.innerText = "";
            result.diametre_nominal ? detailistemodele_diametrenominal.innerText = result.diametre_nominal : detailistemodele_diametrenominal.innerText = "";
            result.p_max_constructeur ? detailistemodele_pmaxc.innerText = result.p_max_constructeur : detailistemodele_pmaxc.innerText = "";
            result.p_min_constructeur ? detailistemodele_pminc.innerText = result.p_min_constructeur : detailistemodele_pminc.innerText = "";
            result.p_max_reel ? detailistemodele_pmaxr.innerText = result.p_max_reel : detailistemodele_pmaxr.innerText = "";
            result.p_min_reel ? detailistemodele_pminr.innerText = result.p_min_reel : detailistemodele_pminr.innerText = "";
            result.p_test ? detailistemodele_ptarage.innerText = result.p_test : detailistemodele_ptarage.innerText = "";
            result.t_max_constructeur ? detailistemodele_tmaxc.innerText = result.t_max_constructeur : detailistemodele_tmaxc.innerText = "";
            result.t_min_constructeur ? detailistemodele_tminc.innerText = result.t_min_constructeur : detailistemodele_tminc.innerText = "";
            result.t_max_reel ? detailistemodele_tmaxr.innerText = result.t_max_reel : detailistemodele_tmaxr.innerText = "";
            result.t_min_reel ? detailistemodele_tminr.innerText = result.t_min_reel : detailistemodele_tminr.innerText = "";
            result.categorie_fluide_frigorigene ? detailistemodele_categorieff.innerText = result.categorie_fluide_frigorigene : detailistemodele_categorieff.innerText = "";
            result.categorie_de_risque ? detailistemodele_catderisque.innerText = result.categorie_de_risque : detailistemodele_catderisque.innerText = "";
            result.numero_de_serie ? detailistemodele_numerodeserie.innerText = result.numero_de_serie : detailistemodele_numerodeserie.innerText = "";
            result.annee ? detailistemodele_annee.innerText = result.annee : detailistemodele_annee.innerText = "";
            result.chapitre ? detailistemodele_chapitre.innerText = result.chapitre : detailistemodele_chapitre.innerText = "";
            result.periodicite_inspection ? detailistemodele_periodiciteinspection.innerText = result.periodicite_inspection : detailistemodele_periodiciteinspection.innerText = "";
        }
    })
})