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
                <p class="mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 1 - Type de modèle</p>
                <p class="mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 2 - Modèle</p>
                <p class="mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 3 - Récapitulatif</p>
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
                <div class="etape" data-toggle="etape2">
                    <h2>Modèle correspondant</h2>
                    <div class="addmodele_listemodele listemodele_etape2 max-h-[300px] overflow-y-auto">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="addmodele_searchmodele" placeholder="Rechercher parmi les modèles">
                        </div>
                        @foreach ($addensemble_listeModeles as $item)
                            <p data-toggle="{{$item->type}}">{{$item->designation}} ({{$item->reference}})</p>
                        @endforeach
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
                    <button class="nextetape" data-target='etape3' disabled>Valider</button>
                </div>
                <div class="etape" data-toggle="etape3">
                    <h2>Récapitulatif</h2>
                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_type",
                        "type" => "text",
                        "placeholder" => "Type",
                        "disabled" => "disabled"
                    ])
                    <button class="save-addmodele">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const btn_close_addmodele = document.querySelector(".btn-close-addmodele");
    const popup_addmodele = document.querySelector(".popup-addmodele");

    const btn_nextetape_to2 = document.querySelector(".nextetape[data-target='etape2']");
    const btn_nextetape_to3 = document.querySelector(".nextetape[data-target='etape3']");
    const etape1_choice = document.querySelectorAll(".addmodele_listetype > p");

    const addmodele_searchmodele = document.querySelector("#addmodele_searchmodele");
    const addmodele_field_to_search = document.querySelectorAll(".listemodele_etape2 > p");

    let LAST_TYPE_CLICKED = null, 
        LAST_MODELE_CLICKED = null,
        TYPE_CHOSEN = "";

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
                if (LAST_TYPE_CLICKED == this) btn_nextetape_to2.setAttribute("disabled", "true");
            }
            LAST_TYPE_CLICKED = this;
        })
    })

    btn_nextetape_to2.addEventListener("click", function(){
        fetch("/get_liste_modele", {
            method: "POST",
            headers: {
                "Content-type":"application/json"
            },
            body: JSON.stringify({_token: _token, type: TYPE_CHOSEN})
        }).then(result => {
            return result.json();
        }).then(result => {
            console.log(result);
        }).catch(error => {
            console.log(error);
        })
    })

    addmodele_field_to_search.forEach((p) => {
        p.addEventListener("click", function(){
            if (LAST_MODELE_CLICKED !== null && LAST_MODELE_CLICKED !== this){
                LAST_MODELE_CLICKED.classList.remove("actif");
            }+
            if (this.classList.contains("actif")) this.classList.remove("actif");
            else{
                this.classList.add("actif");
                LAST_MODELE_CLICKED = this;
            };
        })
    })

    /*let addmodele_search_timeout;
    addmodele_searchmodele.addEventListener("input", function(){

        let result = 0;
        clearTimeout(addmodele_search_timeout);
        if (this.value.length > 3){
            addmodele_search_timeout = setTimeout(function(){
                console.log("start search", );
                addmodele_field_to_search.forEach((item) => {
                    if (!item.innerText.includes(addmodele_searchmodele.value)){
                        item.classList.add("hidden")
                    } else {
                        item.classList.remove("hidden");
                    }
                })
            }, 500);
        }
        console.log(result);
    })*/

</script>