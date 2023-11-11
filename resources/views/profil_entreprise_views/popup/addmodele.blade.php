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

                    <!--<table class="addmodele_table mb-3">
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
                    </table>-->
                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_tarage",
                        "type" => "number",
                        "placeholder" => "Tarage",
                        "classparent" => "w-full mb-3 addmodele_tarage"
                    ])
                    
                    <!--@include("components.floatinginput", [
                        "id" => "addmodele_etape2_categorie_ff",
                        "type" => "text",
                        "placeholder" => "Catégorie fluide frigorigène",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])-->

                    <!--<h3>Données terrain : </h3>
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
                    </table>-->

                    <!--@include("components.floatinginput", [
                        "id" => "addmodele_etape2_date_mes",
                        "type" => "number",
                        "placeholder" => "Date mise en service",
                        "classparent" => "w-full mb-3"
                    ])-->

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_categoriederisque",
                        "type" => "text",
                        "placeholder" => "Catégorie de risque",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_chapitre",
                        "type" => "text",
                        "placeholder" => "Chapitre",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_DMS",
                        "type" => "number",
                        "placeholder" => "DMS",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_volume",
                        "type" => "number",
                        "placeholder" => "Volume",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_dn",
                        "type" => "number",
                        "placeholder" => "Diamètre nominal",
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

                    @include("components.floatinginput", [
                        "id" => "addmodele_etape2_annee_mes",
                        "type" => "number",
                        "placeholder" => "Année mise en service",
                        "classparent" => "w-full mb-3"
                    ])
                    <button class="btn-cancel addmodele_prev_etape w-fit" data-target="etape1">Précédent</button>
                    <button class="nextetape" data-target='etape3' disabled>Valider</button>
                </div>

                <div class="etape hidden" data-toggle="etape3">
                    <h2>Récapitulatif</h2>
                    <div class="flex w-full mb-3">
                        @include("components.floatinginput", [
                            "id" => "addmodele_recap_type",
                            "type" => "text",
                            "placeholder" => "Type",
                            "disabled" => "disabled",
                            "classparent" => "w-full mr-3"
                        ])

                        @include("components.floatinginput", [
                            "id" => "addmodele_recap_nature",
                            "type" => "text",
                            "placeholder" => "Nature",
                            "disabled" => "disabled",
                            "classparent" => "w-full"
                        ])
                    </div>

                    <div class="flex w-full mb-3">
                        @include("components.floatinginput", [
                            "id" => "addmodele_recap_designation",
                            "type" => "text",
                            "placeholder" => "Designation",
                            "disabled" => "disabled",
                            "classparent" => "w-full mr-3"
                        ])

                        @include("components.floatinginput", [
                            "id" => "addmodele_recap_reference",
                            "type" => "text",
                            "placeholder" => "Réference",
                            "disabled" => "disabled",
                            "classparent" => "w-full"
                        ])
                    </div>
                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_fabricant",
                        "type" => "text",
                        "placeholder" => "Type",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_tarage",
                        "type" => "text",
                        "placeholder" => "Tarage",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3 addmodele_recap_tarage_container"
                    ])
                    
                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_volume",
                        "type" => "text",
                        "placeholder" => "Volume",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3 addmodele_recap_tarage_container"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_dn",
                        "type" => "text",
                        "placeholder" => "Diamètre nominal",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3 addmodele_recap_tarage_container"
                    ])
                    
                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_categorie_ff",
                        "type" => "text",
                        "placeholder" => "Catégorie fluide frigorigène",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    <!--<table class="addmodele_table mb-3">
                        <thead>
                            <tr>
                                <th>P_max Constructeur</th>
                                <th>P_min Constructeur</th>
                                <th>T_max Constructeur</th>
                                <th>T_min Constructeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="addmodele_recap_pmaxc"></td>
                                <td class="addmodele_recap_pminc"></td>
                                <td class="addmodele_recap_tmaxc"></td>
                                <td class="addmodele_recap_tminc"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="addmodele_table mb-3">
                        <thead>
                            <tr>
                                <th>P_max Réel</th>
                                <th>P_min Réel</th>
                                <th>T_max Réel</th>
                                <th>T_min Réel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="addmodele_recap_pmaxr"></td>
                                <td class="addmodele_recap_pminr"></td>
                                <td class="addmodele_recap_tmaxr"></td>
                                <td class="addmodele_recap_tminr"></td>
                            </tr>
                        </tbody>
                    </table>-->

                    <!--@include("components.floatinginput", [
                        "id" => "addmodele_recap_date_mes",
                        "type" => "number",
                        "placeholder" => "Date mise en service",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])-->

                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_numerodeserie",
                        "type" => "text",
                        "placeholder" => "Numéro de série",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_annee",
                        "type" => "number",
                        "placeholder" => "Année",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    @include("components.floatinginput", [
                        "id" => "addmodele_recap_annee_mes",
                        "type" => "number",
                        "placeholder" => "Année mise en service",
                        "disabled" => "disabled",
                        "classparent" => "w-full mb-3"
                    ])

                    <button class="btn-cancel addmodele_prev_etape w-fit" data-target="etape2">Précédent</button>
                    <button class="save-addmodele" data-userparent="{{$userId}}" data-siteparent="{{$site_parent}}" data-ensembleparent="{{$ensemble_parent}}">Ajouter cet ensemble</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loading_addmodele_modele hidden">
    <span class="spinner spinner-border text-secondary w-[80px] h-[80px]"></span>
</div>
<script src="{{asset('js/profil_entreprise_scripts/addmodele.js')}}"></script>