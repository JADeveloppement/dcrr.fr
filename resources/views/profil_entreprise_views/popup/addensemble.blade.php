@php
    use App\Models\Marques;
    use App\Models\Fluides;
    use App\Models\User;
    use App\Models\DataModele;
    use App\Models\DataModeleType;

    $addensemble_liste = DataModele::join("data_modele_designation", "data_modele_designation.id", "=", "data_generic_modele.designation")
                            ->join("data_modele_reference", "data_modele_reference.id", "=", "data_generic_modele.complement_reference")
                            ->select("data_generic_modele.id", "data_modele_designation.modele_designation", "data_modele_reference.modele_reference")
                            ->where("type", DataModeleType::where("modele_type", "Ensemble")->first()->id)->get();
    $user_parent = User::where("email", Cookie::get("dcrr_login"))->first()->id;

    if (request()->has('userId') && User::find(intval(request()->userId)))
        $user_parent = intval(request()->userId);

    $listeff = Fluides::get();

@endphp
<div class="container justify-start popup-addensemble" style="top: -100vh;">
    <div class="box relative">
        <h2>Ajouter un ensemble</h2>

        <div class="flex justify-start w-full my-3">
            @include("components.floatinginput", [
                "id" => "field_addensemble_type",
                "type" => "text",
                "placeholder" => "Type d'installation",
                "disabled" => "disabled",
                "value" => "Ensemble",
                "classparent" => "w-full"
            ])
        </div>

        <div class="flex w-full mb-3">
            <select class="form-select" id="field_addensemble_ensemble">
                <option value="0">-- Choisir un ensemble --</option>
                @foreach ($addensemble_liste as $item)
                    <option value="{{$item->id}}">{{$item->modele_designation}} ({{$item->modele_reference}})</option>
                @endforeach
            </select>
        </div>

        <div class="flex w-full mb-3">
            <select class="form-select" id="addensemble_ff">
                <option value="0">-- Choisir un fluide frigorigène --</option>
                @foreach ($listeff as $item)
                    <option value="{{$item->id}}">{{$item->nom_fluide}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex w-full mb-3">
            @include("components.floatinginput", [
                "id" => "field_addensemble_nature",
                "type" => "text",
                "placeholder" => "Nature",
                "disabled" => "disabled",
                "classparent" => "w-full mr-3"
            ])

            @include("components.floatinginput", [
                "id" => "field_addensemble_fabricant",
                "type" => "text",
                "placeholder" => "Fabricant",
                "disabled" => "disabled",
                "classparent" => "w-full"
            ])
        </div>

        <div class="flex w-full mb-3">
            @include("components.floatinginput", [
                "id" => "field_addensemble_designation",
                "type" => "text",
                "placeholder" => "Désignation",
                "disabled" => "disabled",
                "classparent" => "w-full mr-3"
            ])
            @include("components.floatinginput", [
                "id" => "field_addensemble_reference",
                "type" => "text",
                "placeholder" => "Référence",
                "disabled" => "disabled",
                "classparent" => "w-full"
            ])
        </div>

        <!--<div class="flex w-full mb-3">
            <table class="addensemble-table">
                <thead class>
                    <tr>
                        <th>P_MIN Constructeur</th>
                        <th>P_MAX Constructeur</th>
                        <th>T_MIN Constructeur</th>
                        <th>T_MAX Constructeur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- <td class="addensemble_table_td_pminC"></td>
                        <td class="addensemble_table_td_pmaxC"></td>
                        <td class="addensemble_table_td_tminC"></td> --}}
                        <td class="addensemble_table_td_tmaxC"></td>
                    </tr>
                </tbody>
            </table>
        </div>-->

        <!--<div class="flex justify-start w-full mb-3">
            @include("components.floatinginput", [
                "id" => "field_addensemble_tarage",
                "type" => "text",
                "placeholder" => "Tarage",
                "disabled" => "disabled",
                "value" => "Tarage",
                "classparent" => "w-full"
            ])
        </div>-->

        <div class="flex justify-start w-full mb-3">
            @include("components.floatinginput", [
                "id" => "field_addensemble_annee",
                "type" => "text",
                "placeholder" => "Année Mise en service",
                "classparent" => "w-full mr-3"
            ])
            @include("components.floatinginput", [
                "id" => "field_addensemble_numerodeserie",
                "type" => "text",
                "placeholder" => "Numéro de série",
                "classparent" => "w-full"
            ])
        </div>

        @include("components.floatinginput", [
            "id" => "field_addensemble_datevi",
            "type" => "text",
            "placeholder" => "Date VI",
            "classparent" => "w-full mr-3"
        ])

        <hr>

        <div class="flex w-full flex-col mb-3">
            <div class="card">
                <h3>Données frigoriste : </h3>
                <table class="addensemble-table-pression mb-3">
                    <thead>
                        <tr>
                            <th>Pmax HP</th>
                            <th>Pmin HP</th>
                            <th>Pmax MP</th>
                            <th>Pmin MP</th>
                            <th>Pmax BP</th>
                            <th>Pmin BP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldpmaxhp",
                                    "type" => "number",
                                    "placeholder" => "Pmax HP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldpminhp",
                                    "type" => "number",
                                    "placeholder" => "Pmin HP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldpmaxmp",
                                    "type" => "number",
                                    "placeholder" => "Pmax MP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldpminmp",
                                    "type" => "number",
                                    "placeholder" => "Pmin MP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldpmaxbp",
                                    "type" => "number",
                                    "placeholder" => "Pmax BP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldpminbp",
                                    "type" => "number",
                                    "placeholder" => "Pmin BP"
                                ])
                            </td>
                        </tr>    
                    </tbody>
                </table>

                <table class="addensemble-table-pression">
                    <thead>
                        <tr>
                            <th>Tmax HP</th>
                            <th>Tmin HP</th>
                            <th>Tmax MP</th>
                            <th>Tmin MP</th>
                            <th>Tmax BP</th>
                            <th>Tmin BP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldtmaxhp",
                                    "type" => "number",
                                    "placeholder" => "Tmax HP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldtminhp",
                                    "type" => "number",
                                    "placeholder" => "Tmin HP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldtmaxmp",
                                    "type" => "number",
                                    "placeholder" => "Tmax MP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldtminmp",
                                    "type" => "number",
                                    "placeholder" => "Tmin MP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldtmaxbp",
                                    "type" => "number",
                                    "placeholder" => "Tmax BP"
                                ])
                            </td>
                            <td>
                                @include("components.floatinginput", [
                                    "id" => "addensemble_fieldtminbp",
                                    "type" => "number",
                                    "placeholder" => "Tmin BP"
                                ])
                            </td>
                        </tr>                    
                    </tbody>
                </table>
            </div>
        </div>

        @include("components.floatinginput", [
            "id" => "addensemble_designationclient",
            "type" => "text",
            "placeholder" => "Désignation client",
            "classparent" => "w-full"
        ])

        <button class="btn-save-addensemble w-full" data-userparent="{{$user_parent}}" data-siteparent="{{request()->displaySite}}" data-modeleparent="0">Enregistrer</button>
        <button class="btn-cancel btn-close-addensemble">Annuler</button>
    </div>
</div>

<script>
    const _token = document.querySelector("meta[name='_token']").getAttribute("content");

    const loading_spinner = "<span class='spinner spinner-border'></span>";

    const btn_close_addensemble = document.querySelector(".btn-close-addensemble");
    const popup_addensemble = document.querySelector(".popup-addensemble");
    const popup_addensemble_box = document.querySelector(".popup-addensemble > .box");

    const field_addensemble_nature = document.querySelector("#field_addensemble_nature");
    const field_addensemble_fabricant = document.querySelector("#field_addensemble_fabricant");
    const field_addensemble_designation = document.querySelector("#field_addensemble_designation");
    const field_addensemble_reference = document.querySelector("#field_addensemble_reference");
    // const field_addensemble_tarage = document.querySelector("#field_addensemble_tarage");

    //const addensemble_table_td_pminC = document.querySelector(".addensemble_table_td_pminC");
    //const addensemble_table_td_pmaxC = document.querySelector(".addensemble_table_td_pmaxC");
    //const addensemble_table_td_tminC = document.querySelector(".addensemble_table_td_tminC");
    //const addensemble_table_td_tmaxC = document.querySelector(".addensemble_table_td_tmaxC");

    function fetch_data(id){
        return fetch("get_modele_detail", {
            method: "POST",
            headers: {
                "Content-type" : "application/json"
            },
            body: JSON.stringify({
                _token: _token,
                id: id
            })
        }).then(response => {
            return response.json();
        }).then(result => {
            return result;
        }).catch(error => {
            return error;
        });
    }

    btn_close_addensemble.addEventListener("click", function(){
        popup_addensemble.style.top = "-100vh";
    })

    const btn_save_addensemble = document.querySelector(".btn-save-addensemble");
    const addensemble_select = document.querySelector("#field_addensemble_ensemble");

    addensemble_select.addEventListener("change", async function(){
        field_addensemble_nature.value = "...";
        field_addensemble_fabricant.value = "...";
        field_addensemble_designation.value = "...";
        field_addensemble_reference.value = "...";
        // field_addensemble_tarage.value = "...";

        //addensemble_table_td_pminC.innerHTML = loading_spinner;
        //addensemble_table_td_pmaxC.innerHTML = loading_spinner;
        //addensemble_table_td_tminC.innerHTML = loading_spinner;
        //addensemble_table_td_tmaxC.innerHTML = loading_spinner;

        try {
            this.setAttribute("disabled", "true");
            btn_save_addensemble.setAttribute("disabled", "true");
            btn_save_addensemble.innerHTML = loading_spinner;

            const id = this.value;
            const r = await fetch_data(id);
            field_addensemble_nature.value = r.nature;
            field_addensemble_fabricant.value = r.fabricant;
            field_addensemble_designation.value = r.designation;
            field_addensemble_reference.value = r.complement_reference;
            // field_addensemble_tarage.value = r.tarage;
            
            //addensemble_table_td_pminC.innerHTML = r.pminc;
            //addensemble_table_td_pmaxC.innerHTML = r.pmaxc;
            //addensemble_table_td_tminC.innerHTML = r.tminc;
            //addensemble_table_td_tmaxC.innerHTML = r.tmaxc;
            this.removeAttribute("disabled");
            btn_save_addensemble.removeAttribute("disabled");
            btn_save_addensemble.innerHTML = "Enregistrer";
        } catch(error){
            console.log(error);
        }
    })
</script>