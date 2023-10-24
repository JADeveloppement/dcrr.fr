import {fetch_result, toggleButtonClick, do_popup} from "./../utils.js";
const _token = document.querySelector("meta[name='_token']").getAttribute("content");

const etape1_container = document.querySelector(".etape[data-toggle='etape1']");
const etape2_container = document.querySelector(".etape[data-toggle='etape2']");
const etape3_container = document.querySelector(".etape[data-toggle='etape3']");

const etape1_indicator = document.querySelector(".addmodele_etape1_indicator");
const etape2_indicator = document.querySelector(".addmodele_etape2_indicator");
const etape3_indicator = document.querySelector(".addmodele_etape3_indicator");

const icon_etape1_indicator = document.querySelector(".addmodele_etape1_indicator > .bi");
const icon_etape2_indicator = document.querySelector(".addmodele_etape2_indicator > .bi");
const icon_etape3_indicator = document.querySelector(".addmodele_etape3_indicator > .bi");

const icon_etapeOK = "bi-check";
const span_loading = "<span class='spinner spinner-border text-secondary'></span>";

const btn_close_addmodele = document.querySelector(".btn-close-addmodele");
const popup_addmodele = document.querySelector(".popup-addmodele");

const addmodele_prev_etape = document.querySelectorAll(".addmodele_prev_etape");

const btn_nextetape_to2 = document.querySelector(".nextetape[data-target='etape2']");
const etape1_choice = document.querySelectorAll(".addmodele_listetype > p");

const addmodele_searchmodele = document.querySelector("#addmodele_searchmodele");
const etape2_choice = document.querySelectorAll(".listemodele_etape2 > p");
const btn_nextetape_to3 = document.querySelector(".nextetape[data-target='etape3']");
const addmodele_modele_loading = document.querySelector(".loading_addmodele_modele");

const addmodele_etape2_type = document.querySelector("#addmodele_etape2_type");
const addmodele_etape2_nature = document.querySelector("#addmodele_etape2_nature");
const addmodele_etape2_designation = document.querySelector("#addmodele_etape2_designation");
const addmodele_etape2_reference = document.querySelector("#addmodele_etape2_reference");
const addmodele_pminc = document.querySelector(".addmodele_pminc");
const addmodele_pmaxc = document.querySelector(".addmodele_pmaxc");
const addmodele_tminc = document.querySelector(".addmodele_tminc");
const addmodele_tmaxc = document.querySelector(".addmodele_tmaxc");
const addmodele_etape2_tarage = document.querySelector("#addmodele_etape2_tarage");
const addmodele_etape2_categorie_ff = document.querySelector("#addmodele_etape2_categorie_ff");
const addmodele_etape2_pminr = document.querySelector("#addmodele_etape2_pminr");
const addmodele_etape2_pmaxr = document.querySelector("#addmodele_etape2_pmaxr");
const addmodele_etape2_tminr = document.querySelector("#addmodele_etape2_tminr");
const addmodele_etape2_tmaxr = document.querySelector("#addmodele_etape2_tmaxr");
const addmodele_etape2_date_mes = document.querySelector("#addmodele_etape2_date_mes");
const addmodele_etape2_numerodeserie = document.querySelector("#addmodele_etape2_numerodeserie");
const addmodele_etape2_annee = document.querySelector("#addmodele_etape2_annee");

const addmodele_recap_type = document.querySelector("#addmodele_recap_type")
const addmodele_recap_nature = document.querySelector("#addmodele_recap_nature")
const addmodele_recap_designation = document.querySelector("#addmodele_recap_designation")
const addmodele_recap_reference = document.querySelector("#addmodele_recap_reference")
const addmodele_recap_fabricant = document.querySelector("#addmodele_recap_fabricant")
const addmodele_recap_tarage = document.querySelector("#addmodele_recap_tarage")
const addmodele_recap_categorie_ff = document.querySelector("#addmodele_recap_categorie_ff")
const addmodele_recap_pmaxc = document.querySelector(".addmodele_recap_pmaxc")
const addmodele_recap_pminc = document.querySelector(".addmodele_recap_pminc")
const addmodele_recap_tmaxc = document.querySelector(".addmodele_recap_tmaxc")
const addmodele_recap_tminc = document.querySelector(".addmodele_recap_tminc")
const addmodele_recap_pmaxr = document.querySelector(".addmodele_recap_pmaxr")
const addmodele_recap_pminr = document.querySelector(".addmodele_recap_pminr")
const addmodele_recap_tmaxr = document.querySelector(".addmodele_recap_tmaxr")
const addmodele_recap_tminr = document.querySelector(".addmodele_recap_tminr")
const addmodele_recap_date_mes = document.querySelector("#addmodele_recap_date_mes")
const addmodele_recap_numerodeserie = document.querySelector("#addmodele_recap_numerodeserie")
const addmodele_recap_annee = document.querySelector("#addmodele_recap_annee")

const save_addmodele = document.querySelector(".save-addmodele");

let LAST_TYPE_CLICKED = null, 
    LAST_MODELE_CLICKED = null,
    TYPE_CHOSEN = "",
    MODELE_CHOSEN = "";

function addmodele_init_all_field(){
    etape1_choice.forEach((item) => {
        item.classList.remove("actif")
    })
    etape1_indicator.classList.add("addmodele_etape_actif");
    icon_etape1_indicator.classList.add("bi-lock");
    icon_etape1_indicator.classList.remove(icon_etapeOK);
    btn_nextetape_to2.setAttribute("disabled", "true");

    resetEtape2();
    resetEtape3();

    LAST_TYPE_CLICKED = null;
    TYPE_CHOSEN = "";
}

function resetEtape3(){
    addmodele_recap_type.value = "..";
    addmodele_recap_nature.value = "..";
    addmodele_recap_designation.value = "..";
    addmodele_recap_reference.value = "..";
    addmodele_recap_fabricant.value = "..";
    addmodele_recap_tarage.value = "";
    addmodele_recap_pmaxc.innerHTML = span_loading
    addmodele_recap_pminc.innerHTML = span_loading
    addmodele_recap_tmaxc.innerHTML = span_loading
    addmodele_recap_tminc.innerHTML = span_loading
    addmodele_recap_categorie_ff.value = "..";
    addmodele_recap_pmaxr.innerHTML = span_loading
    addmodele_recap_pminr.innerHTML = span_loading
    addmodele_recap_tmaxr.innerHTML = span_loading
    addmodele_recap_tminr.innerHTML = span_loading
    addmodele_recap_date_mes.value = "";
    addmodele_recap_numerodeserie.value = "";
    addmodele_recap_annee.value = "";

    etape3_indicator.classList.remove("addmodele_etape_actif");
    icon_etape3_indicator.classList.add("bi-lock");
    icon_etape3_indicator.classList.remove(icon_etapeOK);
}

function resetEtape2(){
    etape2_choice.forEach((item) => {
        item.classList.remove("actif")
    })

    addmodele_etape2_type.value = "";
    addmodele_etape2_nature.value = "";
    addmodele_etape2_designation.value = "";
    addmodele_etape2_reference.value = "";
    addmodele_pminc.innerHTML = "";
    addmodele_pmaxc.innerHTML = "";
    addmodele_tminc.innerHTML = "";
    addmodele_tmaxc.innerHTML = "";
    addmodele_etape2_tarage.innerHTML = "";
    addmodele_etape2_pminr.value = "";
    addmodele_etape2_pmaxr.value = "";
    addmodele_etape2_tminr.value = "";
    addmodele_etape2_tmaxr.value = "";
    addmodele_etape2_date_mes.value = "";
    addmodele_etape2_numerodeserie.value = "";
    addmodele_etape2_annee.value = "";
    LAST_MODELE_CLICKED = null;
    MODELE_CHOSEN = "";
    btn_nextetape_to3.setAttribute("disabled", "true");

    etape2_indicator.classList.add("addmodele_etape_actif");
    icon_etape2_indicator.classList.add("bi-lock");
    icon_etape2_indicator.classList.remove(icon_etapeOK);
}

addmodele_prev_etape.forEach((item) => {
    item.addEventListener("click", function(){
        const etape_to_go = this.getAttribute("data-target");
        switch (etape_to_go){
            case "etape2":
                etape3_container.classList.add("hidden");
                etape2_container.classList.remove("hidden");

                resetEtape3();

                break;
            case "etape1":
                MODELE_CHOSEN = "";
                etape2_container.classList.add("hidden");
                etape1_container.classList.remove("hidden");

                addmodele_init_all_field();
                break;
        }
    })
})

btn_close_addmodele.addEventListener("click", function(){
    popup_addmodele.style.top = "-100vh";
})

etape1_choice.forEach((item) => {
    item.addEventListener("click", function(){
        if (LAST_TYPE_CLICKED !== null && LAST_TYPE_CLICKED !== this){
            LAST_TYPE_CLICKED.classList.remove("actif")
        }
        if (!this.classList.contains("actif")){
            this.classList.add("actif")
            TYPE_CHOSEN = this.innerText;
            btn_nextetape_to2.removeAttribute("disabled");
        }
        else{
            this.classList.remove("actif");
            if (LAST_TYPE_CLICKED == this){
                btn_nextetape_to2.setAttribute("disabled", "true");
                TYPE_CHOSEN = "";
            } 
        }
        LAST_TYPE_CLICKED = this;

        console.log("TYPE CHOSEN : ", TYPE_CHOSEN);
    })
})

let CATEGORIE = "";

btn_nextetape_to2.addEventListener("click", function(){
    etape1_container.classList.add("hidden");
    etape2_container.classList.remove("hidden");

    etape1_indicator.classList.remove("addmodele_etape_actif");
    icon_etape1_indicator.classList.remove("bi-lock");
    icon_etape1_indicator.classList.add(icon_etapeOK);

    etape2_indicator.classList.add("addmodele_etape_actif");
    icon_etape2_indicator.classList.remove("bi-lock");
    icon_etape2_indicator.classList.add(icon_etapeOK);

    etape2_choice.forEach((p) => {
        if (p.getAttribute('data-toggle') == TYPE_CHOSEN){
            p.setAttribute("data-chosen", "true");
        } else {
            p.setAttribute("data-chosen", "false");
        }
    })

})

async function get_modele_detail(id){
    addmodele_etape2_type.value = "...";
    addmodele_etape2_nature.value = "...";
    addmodele_etape2_designation.value = "...";
    addmodele_etape2_reference.value = "...";
    addmodele_etape2_tarage.value = "...";
    addmodele_pminc.innerHTML = span_loading;
    addmodele_pmaxc.innerHTML = span_loading;
    addmodele_tminc.innerHTML = span_loading;
    addmodele_tmaxc.innerHTML = span_loading;

    addmodele_etape2_type.classList.add("animate-pulse");
    addmodele_etape2_nature.classList.add("animate-pulse");
    addmodele_etape2_designation.classList.add("animate-pulse");
    addmodele_etape2_reference.classList.add("animate-pulse");

    addmodele_modele_loading.classList.remove("hidden");
    addmodele_modele_loading.classList.add("flex");

    try {
        const result = await fetch_result("/get_modele_detail", {
            _token: _token,
            id: id
        });
        addmodele_etape2_type.value = result.type;
        addmodele_etape2_nature.value = result.nature;
        addmodele_etape2_designation.value = result.designation;
        addmodele_etape2_reference.value = result.complement_reference;
        addmodele_pminc.innerHTML = result.pminc;
        addmodele_pmaxc.innerHTML = result.pmaxc;
        addmodele_tminc.innerHTML = result.tminc;
        addmodele_tmaxc.innerHTML = result.tmaxc;
        addmodele_etape2_tarage.value = result.tarage;

        addmodele_modele_loading.classList.add("hidden");
        addmodele_modele_loading.classList.remove("flex");
        addmodele_etape2_type.classList.remove("animate-pulse");
        addmodele_etape2_nature.classList.remove("animate-pulse");
        addmodele_etape2_designation.classList.remove("animate-pulse");
        addmodele_etape2_reference.classList.remove("animate-pulse");
    }catch(error){
        do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
    }

    /*fetch("/get_modele_detail", {
        method: "POST",
        headers : {
            "Content-type" : "application/json"
        },
        body: JSON.stringify({
            _token: _token,
            id: id
        })
    }).then(response => {
        return response.json();
    }).then(result => {
        addmodele_modele_loading.classList.add("hidden");
        addmodele_modele_loading.classList.remove("flex");
        addmodele_etape2_type.value = result.type;
        addmodele_etape2_nature.value = result.nature;
        addmodele_etape2_designation.value = result.designation;
        addmodele_etape2_reference.value = result.complement_reference;
        addmodele_pminc.innerHTML = result.pminc;
        addmodele_pmaxc.innerHTML = result.pmaxc;
        addmodele_tminc.innerHTML = result.tminc;
        addmodele_tmaxc.innerHTML = result.tmaxc;
        addmodele_etape2_tarage.value = result.tarage;

        addmodele_etape2_type.classList.remove("animate-pulse");
        addmodele_etape2_nature.classList.remove("animate-pulse");
        addmodele_etape2_designation.classList.remove("animate-pulse");
        addmodele_etape2_reference.classList.remove("animate-pulse");
    }).catch(error => {
        do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
    })*/
}

etape2_choice.forEach((p) => {
    p.addEventListener("click", function(){
        if (LAST_MODELE_CLICKED !== null && LAST_MODELE_CLICKED !== this){
            LAST_MODELE_CLICKED.classList.remove("actif")
        }
        if (!this.classList.contains("actif")){
            this.classList.add("actif")
            MODELE_CHOSEN = this.innerText;
            btn_nextetape_to3.removeAttribute("disabled");
            get_modele_detail(this.getAttribute("data-id"));
            btn_nextetape_to3.setAttribute("data-id", this.getAttribute("data-id"));
        }
        else{
            this.classList.remove("actif");
            if (LAST_MODELE_CLICKED == this){
                btn_nextetape_to3.setAttribute("disabled", "true");
                MODELE_CHOSEN = "";
                btn_nextetape_to3.removeAttribute("data-id");
                resetEtape2();
            }
        }
        LAST_MODELE_CLICKED = this;
    })
})

btn_nextetape_to3.addEventListener("click", async function(){
    // addmodele_etape2_date_mes.value.length == 0 ? addmodele_etape2_date_mes.classList.add("is-invalid") : addmodele_etape2_date_mes.classList.remove("is-invalid");
    // addmodele_etape2_numerodeserie.value.length == 0 ? addmodele_etape2_numerodeserie.classList.add("is-invalid") : addmodele_etape2_numerodeserie.classList.remove("is-invalid");
    // addmodele_etape2_annee.value.length == 0 ? addmodele_etape2_annee.classList.add("is-invalid") : addmodele_etape2_annee.classList.remove("is-invalid");

    // if (!addmodele_etape2_date_mes.classList.contains("is-invalid") && !addmodele_etape2_numerodeserie.classList.contains("is-invalid") && !addmodele_etape2_annee.classList.contains("is-invalid")){
    etape2_container.classList.add("hidden");
    etape3_container.classList.remove("hidden");

    etape2_indicator.classList.remove("addmodele_etape_actif");
    icon_etape2_indicator.classList.remove("bi-lock");
    icon_etape2_indicator.classList.add(icon_etapeOK);

    etape3_indicator.classList.add("addmodele_etape_actif");
    icon_etape3_indicator.classList.remove("bi-lock");
    icon_etape3_indicator.classList.add(icon_etapeOK);

    const id = this.getAttribute("data-id");

    try {
        const result = await fetch_result("/get_modele_detail", {
            _token: _token,
            id: id
        })

        addmodele_recap_type.value = result.type;
        addmodele_recap_nature.value = result.nature;
        addmodele_recap_designation.value = result.designation;
        addmodele_recap_reference.value = result.complement_reference;
        addmodele_recap_fabricant.value = result.fabricant;
        addmodele_recap_tarage.value = result.tarage;
        addmodele_recap_pmaxc.innerHTML = result.pmaxc;
        addmodele_recap_pminc.innerHTML = result.pminc;
        addmodele_recap_tmaxc.innerHTML = result.tmaxc;
        addmodele_recap_tminc.innerHTML = result.tminc;
        addmodele_recap_categorie_ff.value = addmodele_etape2_categorie_ff.value;
        addmodele_recap_pmaxr.innerHTML = addmodele_etape2_pminr.value;
        addmodele_recap_pminr.innerHTML = addmodele_etape2_pmaxr.value;
        addmodele_recap_tmaxr.innerHTML = addmodele_etape2_tminr.value;
        addmodele_recap_tminr.innerHTML = addmodele_etape2_tmaxr.value;
        addmodele_recap_date_mes.value = addmodele_etape2_date_mes.value;
        addmodele_recap_numerodeserie.value = addmodele_etape2_numerodeserie.value;
        addmodele_recap_annee.value = addmodele_etape2_annee.value;
        
        save_addmodele.setAttribute("data-id", id);
    } catch(error){
        do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
    }

    /*fetch("/get_modele_detail", {
        method: "POST",
        headers : {
            "Content-type" : "application/json"
        },
        body: JSON.stringify({
            _token: _token,
            id: id
        })
    }).then(response => {
        return response.json();
    }).then(result => {
        addmodele_recap_type.value = result.type;
        addmodele_recap_nature.value = result.nature;
        addmodele_recap_designation.value = result.designation;
        addmodele_recap_reference.value = result.complement_reference;
        addmodele_recap_fabricant.value = result.fabricant;
        addmodele_recap_tarage.value = result.tarage;
        addmodele_recap_pmaxc.innerHTML = result.pmaxc;
        addmodele_recap_pminc.innerHTML = result.pminc;
        addmodele_recap_tmaxc.innerHTML = result.tmaxc;
        addmodele_recap_tminc.innerHTML = result.tminc;
        addmodele_recap_categorie_ff.value = addmodele_etape2_categorie_ff.value;
        addmodele_recap_pmaxr.innerHTML = addmodele_etape2_pminr.value;
        addmodele_recap_pminr.innerHTML = addmodele_etape2_pmaxr.value;
        addmodele_recap_tmaxr.innerHTML = addmodele_etape2_tminr.value;
        addmodele_recap_tminr.innerHTML = addmodele_etape2_tmaxr.value;
        addmodele_recap_date_mes.value = addmodele_etape2_date_mes.value;
        addmodele_recap_numerodeserie.value = addmodele_etape2_numerodeserie.value;
        addmodele_recap_annee.value = addmodele_etape2_annee.value;
        
        save_addmodele.setAttribute("data-id", id);
    }).catch(error => {
        do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
    })*/
    // }
})

save_addmodele.addEventListener("click", async function(){
    addmodele_modele_loading.classList.remove("hidden");
    addmodele_modele_loading.classList.add("flex");

    const id = this.getAttribute("data-id");
    const user_parent = this.getAttribute("data-userparent");
    const site_parent = this.getAttribute("data-siteparent");
    const ensemble_parent = this.getAttribute("data-ensembleparent");
    
    const categorie_ff = addmodele_recap_categorie_ff.value;
    const pmaxr = addmodele_recap_pmaxr.innerText;
    const pminr = addmodele_recap_pminr.innerText;
    const tmaxr = addmodele_recap_tmaxr.innerText;
    const tminr = addmodele_recap_tminr.innerText;
    const date_mes = addmodele_recap_date_mes.value;
    const numerodeserie = addmodele_recap_numerodeserie.value;
    const annee = addmodele_recap_annee.value;

    const data = {
        _token: _token,
        id: id,
        categorie_ff : categorie_ff,
        pmaxr : pmaxr,
        pminr : pminr,
        tmaxr : tmaxr,
        tminr : tminr,
        date_mes : date_mes,
        numerodeserie : numerodeserie,
        annee : annee,
        user_parent: user_parent,
        site_parent: site_parent,
        ensemble_parent: ensemble_parent,
    }

    addmodele_modele_loading.classList.remove("hidden");
    addmodele_modele_loading.classList.add("flex");

    try {
        const result = await fetch_result("/add_modele", data);
        // addmodele_modele_loading.classList.remove("flex");
        // addmodele_modele_loading.classList.add("hidden");
        do_popup("bg-dcrr-green", "bi-info", "Modèle rajouté avec succès. La page va se rafraichir");
        setTimeout(() => {
            location.reload(true);
        }, 2000);
    }catch(error){
        do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
    }

    /*fetch("/add_modele", {
        method: "POST",
        headers : {
            "Content-type" : "application/json"
        },
        body: JSON.stringify(data)
    }).then(response => {
        return response.json();
    }).then(result => {
        addmodele_modele_loading.classList.remove("flex");
        addmodele_modele_loading.classList.add("hidden");
        location.reload(true);
        console.log(result);
    }).catch(error => {
        do_popup("bg-red-600", "bi-x-octagon", "Erreur : "+error);
    })*/
})