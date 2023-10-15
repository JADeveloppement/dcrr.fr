@php
    use App\Models\Marques;
    use App\Models\Fluides;
    use App\Models\User;
    use App\Models\DataModeleType;
    use App\Models\DataModele;

    $addensemble_listeType = DataModeleType::select("modele_type")->get();

    $addensemble_listeModeles = DataModele::select("data_generic_modele.id as id",
                                                    "data_modele_designation.modele_designation as designation",
                                                    "data_modele_reference.modele_reference as reference",
                                                    "data_modele_type.modele_type as type",)
                                            ->join("data_modele_designation", "data_modele_designation.id", "=", "data_generic_modele.designation")
                                            ->join("data_modele_reference", "data_modele_reference.id", "=", "data_generic_modele.complement_reference")
                                            ->join("data_modele_type", "data_modele_type.id", "=", "data_generic_modele.type")
                                            ->get();

@endphp
<div class="container justify-start popup-addmodele" style="top: -100vh;">
    <div class="box relative">
        <div class="close-addmodel btn-close-addmodele">
            <i class="bi bi-x text-[1.5rem]"></i>
        </div>
        <div class="flex">
            <div class="left">
                <h2 class="mb-3">Ajouter un modèle</h2>
                <p class="addmodele_etape1_indicator mb-2 addmodele_etape_actif"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 1 - Type de modèle</p>
                <p class="addmodele_etape2_indicator mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 2 - Modèle</p>
                <p class="addmodele_etape3_indicator mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 3 - Récapitulatif</p>
            </div>
            <div class="right">
                <div class="etape" data-toggle="etape1">
                    <h2>Type de modèle</h2>
                    <div class="addmodele_listetype">
                        @foreach ($addensemble_listeType as $item)
                            <p>{{$item->modele_type}}</p>
                        @endforeach
                    </div>
                    <button class="nextetape" data-target='etape2' disabled="true">Valider</button>
                </div>

                <div class="etape hidden" data-toggle="etape2">
                    <h2>Modèle correspondant</h2>
                    <div class="addmodele_listemodele listemodele_etape2 max-h-[300px] overflow-y-auto">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="addmodele_searchmodele" placeholder="Rechercher parmi les modèles">
                        </div>
                        @foreach ($addensemble_listeModeles as $item)
                            <p data-toggle="{{$item->type}}" data-chosen="false" data-id="{{$item->id}}">{{$item->designation}} ({{$item->reference}})</p>
                        @endforeach
                        <div class="loading_addmodele_modele hidden">
                            <span class="spinner spinner-border text-secondary w-[80px] h-[80px]"></span>
                        </div>
                    </div>
                    <div class="flex my-3">
                        @include("components.floatinginput", [
                            "id" => "addmodele_etape2_type",
                            "type" => "text",
                            "placeholder" => "Type",
                            "disabled" => "disabled",
                            "classparent" => "w-full mr-3"
                        ])

                        @include("components.floatinginput", [
                            "id" => "addmodele_etape2_nature",
                            "type" => "text",
                            "placeholder" => "Nature",
                            "disabled" => "disabled",
                            "classparent" => "w-full"
                        ])
                    </div>
                    <div class="flex mb-3">
                        @include("components.floatinginput", [
                            "id" => "addmodele_etape2_designation",
                            "type" => "text",
                            "placeholder" => "Désignation",
                            "disabled" => "disabled",
                            "classparent" => "w-full mr-3"
                        ])

                        @include("components.floatinginput", [
                            "id" => "addmodele_etape2_reference",
                            "type" => "text",
                            "placeholder" => "Référence",
                            "disabled" => "disabled",
                            "classparent" => "w-full"
                        ])
                    </div>

                    <table class="addmodele_table mb-3">
                        <thead>
                            <tr>
                                <th>P_min Constructeur</th>
                                <th>P_max Constructeur</th>
                                <th>T_min Constructeur</th>
                                <th>T_max Constructeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="addmodele_pminc"></td>
                                <td class="addmodele_pmaxc"></td>
                                <td class="addmodele_tminc"></td>
                                <td class="addmodele_tmaxc"></td>
                            </tr>
                        </tbody>
                    </table>
                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_tarage",
                        "type" => "text",
                        "placeholder" => "Tarage",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])
                    
                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_categorie_ff",
                        "type" => "text",
                        "placeholder" => "Catégorie fluide frigorigène",
                        "disabled" => "disabeld",
                        "classparent" => "w-full mb-3"
                    ])

                    <h3>Données terrain : </h3>
                    <table class="addmodele_table mb-3">
                        <thead>
                            <tr>
                                <th>P_min réel</th>
                                <th>P_max réel</th>
                                <th>T_min réel</th>
                                <th>T_max réel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    @include("components.floatinginput", [
                                        "id" => "addmodele_etape2_pminr",
                                        "type" => "number",
                                        "placeholder" => "P_min réel",
                                        "classparent" => "w-full"
                                    ])
                                </td>
                                <td>
                                    @include("components.floatinginput", [
                                        "id" => "addmodele_etape2_pmaxr",
                                        "type" => "number",
                                        "placeholder" => "P_max réel",
                                        "classparent" => "w-full"
                                    ])
                                </td>
                                <td>
                                    @include("components.floatinginput", [
                                        "id" => "addmodele_etape2_tminr",
                                        "type" => "number",
                                        "placeholder" => "T_min réel",
                                        "classparent" => "w-full"
                                    ])
                                </td>
                                <td>
                                    @include("components.floatinginput", [
                                        "id" => "addmodele_etape2_tmaxr",
                                        "type" => "number",
                                        "placeholder" => "T_max réel",
                                        "classparent" => "w-full"
                                    ])
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_date_mes",
                        "type" => "number",
                        "placeholder" => "Date mise en service",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_numerodeserie",
                        "type" => "text",
                        "placeholder" => "Numéro de série",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_annee",
                        "type" => "number",
                        "placeholder" => "Année",
                        "classparent" => "w-full mb-3"
                    ])
                    <button class="btn-cancel addmodele_prev_etape w-fit" data-target="etape1">Précédent</button>
                    <button class="nextetape" data-target='etape3' disabled>Valider</button>
                </div>

                <div class="etape hidden" data-toggle="etape3">
                    <h2>Récapitulatif</h2>
                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_type",
                        "type" => "text",
                        "placeholder" => "Type",
                        "disabled" => "disabled"
                    ])
                    <button class="btn-cancel addmodele_prev_etape w-fit" data-target="etape2">Précédent</button>
                    <button class="save-addmodele">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    const addmodele_etape2_pminr = document.querySelector("#addmodele_etape2_pminr");
    const addmodele_etape2_pmaxr = document.querySelector("#addmodele_etape2_pmaxr");
    const addmodele_etape2_tminr = document.querySelector("#addmodele_etape2_tminr");
    const addmodele_etape2_tmaxr = document.querySelector("#addmodele_etape2_tmaxr");
    const addmodele_etape2_date_mes = document.querySelector("#addmodele_etape2_date_mes");
    const addmodele_etape2_numerodeserie = document.querySelector("#addmodele_etape2_numerodeserie");
    const addmodele_etape2_annee = document.querySelector("#addmodele_etape2_annee");

    let LAST_TYPE_CLICKED = null, 
        LAST_MODELE_CLICKED = null,
        TYPE_CHOSEN = "",
        MODELE_CHOSEN = "";

    addmodele_prev_etape.forEach((item) => {
        item.addEventListener("click", function(){
            const etape_to_go = this.getAttribute("data-target");
            switch (etape_to_go){
                case "etape2":
                    etape3_container.classList.add("hidden");
                    etape2_container.classList.remove("hidden");
                    break;
                case "etape1":
                    MODELE_CHOSEN = "";
                    etape2_container.classList.add("hidden");
                    etape1_container.classList.remove("hidden");
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

    btn_nextetape_to2.addEventListener("click", function(){
        etape1_container.classList.add("hidden");
        etape2_container.classList.remove("hidden");

        etape1_indicator.classList.remove("addmodele_etape_actif");
        icon_etape1_indicator.classList.remove("bi-lock");
        icon_etape1_indicator.classList.add(icon_etapeOK);

        etape2_indicator.classList.add("addmodele_etape_actif");

        etape2_choice.forEach((p) => {
            if (p.getAttribute('data-toggle') == TYPE_CHOSEN){
                p.setAttribute("data-chosen", "true");
            } else {
                p.setAttribute("data-chosen", "false");
            }
        })

    })

    function get_modele_detail(id){
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

        fetch("/get_modele_detail", {
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
            console.log(error);
        })
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
            }
            else{
                this.classList.remove("actif");
                if (LAST_MODELE_CLICKED == this){
                    btn_nextetape_to3.setAttribute("disabled", "true");
                    MODELE_CHOSEN = "";
                }
            }
            LAST_MODELE_CLICKED = this;
        })
    })

    btn_nextetape_to3.addEventListener("click", function(){
        addmodele_etape2_date_mes.value.length == 0 ? addmodele_etape2_date_mes.classList.add("is-invalid") : addmodele_etape2_date_mes.classList.remove("is-invalid");
        addmodele_etape2_numerodeserie.value.length == 0 ? addmodele_etape2_numerodeserie.classList.add("is-invalid") : addmodele_etape2_numerodeserie.classList.remove("is-invalid");
        addmodele_etape2_annee.value.length == 0 ? addmodele_etape2_annee.classList.add("is-invalid") : addmodele_etape2_annee.classList.remove("is-invalid");

        if (!addmodele_etape2_date_mes.classList.contains("is-invalid") &&
            !addmodele_etape2_numerodeserie.classList.contains("is-invalid") &&
            !addmodele_etape2_annee.classList.contains("is-invalid")){
                etape2_container.classList.add("hidden");
                etape3_container.classList.remove("hidden");
            }
    })

</script>