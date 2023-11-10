@php
    use App\Models\User;
    use App\Models\ListeSites;

    // Ensembles
    use App\Models\ListeModele;
    use App\Models\DataModeleType;


    $user = User::where("email", Cookie::get("dcrr_login"))->first();

    $userId = $user->id;
    $listeSites = ListeSites::select("listeSites.id as id", 
                                    "listeSites.code_client as code_client", 
                                    "listeSites.nom_client as nom_client", 
                                    "listeSites.code_site as code_site", 
                                    "listeSites.nom_site as nom_site")
                            ->where("proprietaire", $userId)
                            ->get();

    if (request()->has('displaySite')){
        $liste_ensemble = ListeModele::select("listeModele.id as id",
                                            "data_modele_nature.modele_nature as nature",
                                            "data_modele_reference.modele_reference as reference",
                                            "data_modele_designation.modele_designation as designation",
                                            "data_modele_fabricant.modele_fabricant as fabricant",
                                            "listeModele.date_mes as date_mes",
                                            "listeModele.categorie_fluide_frigorigene as categorie_fluide_frigorigene",
                                            "listeModele.numero_de_serie as numero_de_serie",
                                            "listeModele.designation_client as designation_client",
                                            "listeModele.fluide_frigorigene as fluide_frigorigene",
                                            "listeModele.periodicite_ip as periodicite_ip",
                                            "listeModele.periodicite_rq as periodicite_rq",
                                            "listeModele.user_parent as user_parent",
                                            "listeModele.site_parent as site_parent")
                                ->join("data_modele_nature","data_modele_nature.id", "=", "listeModele.nature")
                                ->join("data_modele_reference","data_modele_reference.id", "=", "listeModele.complement_reference")
                                ->join("data_modele_designation","data_modele_designation.id", "=", "listeModele.designation")
                                ->join("data_modele_fabricant","data_modele_fabricant.id", "=", "listeModele.fabricant")
                                ->where("user_parent", intval($userId))
                                ->where("site_parent", intval(request()->displaySite))
                                ->where("type", DataModeleType::where("modele_type", "Ensemble")->first()->id)
                                ->get();
        $site_selected = ListeSites::select("id", "nom_client", "code_client", "nom_site", "code_site")
                        ->where("id", intval(request()->displaySite))
                        ->where("proprietaire", intval($userId))
                        ->first();
    }

    if (request()->has('displayEnsemble')){
        $site_parent = intval(request()->displaySite);
        $ensemble = intval(request()->displayEnsemble);

        $sitefound = ListeSites::where("id", $site_parent)
                                ->where("proprietaire", $userId);
        $ensemblefound = ListeModele::where("id", $ensemble)
                                    ->where("site_parent", $site_parent)
                                    ->where("user_parent", $userId);
        $listemodele = ListeModele::select("data_modele_nature.modele_nature as nature",
                                            "data_modele_designation.modele_designation as designation",
                                            "data_modele_reference.modele_reference as reference",
                                            "data_modele_fabricant.modele_fabricant as fabricant",
                                            "listeModele.id as id",
                                            "listeModele.date_mes as date_mes",
                                            "listeModele.categorie_fluide_frigorigene as categorie_fluide_frigorigene",
                                            "listeModele.annee as annee")
                                    ->join("data_modele_nature", "listeModele.nature", "=", "data_modele_nature.id")
                                    ->join("data_modele_designation", "listeModele.designation", "=", "data_modele_designation.id")
                                    ->join("data_modele_reference", "listeModele.complement_reference", "=", "data_modele_reference.id")
                                    ->join("data_modele_fabricant", "listeModele.fabricant", "=", "data_modele_fabricant.id")
                                    ->where("site_parent", $site_parent)
                                    ->where("user_parent", $userId)
                                    ->where("modele_parent", $ensemble)
                                    ->get();
    }
@endphp
<div class="profil-client-container">
    <div class="card">
        <h2>Mes sites</h2>
        <span class="italic">Cliquez sur une ligne pour afficher ses ensembles associés.</span>
        @if(count($listeSites) == 0)
            Aucun site associés, veuillez faire une demande pour en créer un.
        @else
            <table class="messite-table">
                <thead>
                    <tr>
                        <th>Code Client</th>
                        <th>Nom Client</th>
                        <th>Code Site</th>
                        <th>Nom Site</th>
                        <!--<th>Marque</th>
                        <th>Date de Mise en service</th>
                        <th>Conformité</th>
                        <th>Désignation</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listeSites as $item)
                        <tr @if (request()->has('displaySite') && request()->displaySite == $item->id) class='row-actif' @endif data-toggle="listesites" data-id="{{$item->id}}">
                            <td>{{$item->nom_client}}</td>
                            <td>{{$item->nom_client}}</td>
                            <td>{{$item->code_site}}</td>
                            <td>{{$item->nom_site}}</td>
                            <!--<td>{{$item->marque}}</td>
                            <td>{{$item->date_mise_en_service}}</td>
                            <td>{{$item->conforme}}</td>
                            <td>{{$item->designation}}</td>-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script>
        const tr_site = document.querySelectorAll("tr[data-toggle='listesites']");

        tr_site.forEach((item) => {
            item.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                window.location = `/profil?displayMenu=1&displaySite=${id}`
            })
        })
    </script>

    @if (request()->has('displaySite'))
    <div class="card">
        @if (count($liste_ensemble) == 0)
        <p class="italic">Aucun ensemble disponible, veuillez en créer au moins un.</p>
        @else
        <div class="ensemblesassocies">
            <div class="w-full flex items-center justify-center">
                <table class="w-fit my-4 text-center">
                    <thead class="bg-slate-700 text-white font-extrabold">
                        <tr>
                            <th class="p-4">Nom Client</th>
                            <th class="p-4">Code Client</th>
                            <th class="p-4">Nom Site</th>
                            <th class="p-4">Code Site</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-slate-200">
                            <td class="p-3 border-r-[1px] border-black">{{$site_selected->nom_client}}</td>
                            <td class="p-3 border-r-[1px] border-black">{{$site_selected->code_client}}</td>
                            <td class="p-3 border-r-[1px] border-black">{{$site_selected->nom_site}}</td>
                            <td class="p-3">{{$site_selected->code_site}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h2>Liste des ensembles</h2>
            @include("components.floatinginput", [
                "id" => "field_messites_searchensemble",
                "type" => "text",
                "placeholder" => "Rechercher parmi les ensembles",
                "classparent" => "mt-3"
            ])
            <table class="messite-table">
                <thead>
                    <tr>
                        <!--<th>Désignation</th>
                        <th>Référence</th>
                        <th>Fabricant</th>
                        <th>Date de mise en service</th>
                        <th>Catégorie FF</th>
                        <th>Numéro de série</th>-->
                        <th></th>
                        <th>Fabricant</th>
                        <th>Désignation Client</th>
                        <th>Désignation</th>
                        <th>Date MES</th>
                        <th>Fluide frigorigène</th>
                        <th>Périodicité IP</th>
                        <th>Périodicité RQ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liste_ensemble as $item)
                        <tr @if (request()->has('displayEnsemble') && request()->displayEnsemble == $item->id) class='row-actif' @endif 
                            data-toggle="listeensemble" data-id="{{$item->id}}">
                            <!--<td>{{$item->designation}}</td>
                            <td>{{$item->reference}}</td>
                            <td>{{$item->fabricant}}</td>
                            <td>{{$item->date_mes}}</td>
                            <td>{{$item->categorie_fluide_frigorigene}}</td>
                            <td>{{$item->numero_de_serie}}</td>-->
                            <td>
                                <div class="flex items-center justify-center">
                                    <i class="text-[1.5rem] bi bi-info-circle"></i>
                                </div>
                            </td>
                            <td>{{$item->fabricant}}</td>
                            <td>{{$item->designation_client}}</td>
                            <td>{{$item->designation}}</td>
                            <td>{{$item->date_mes}}</td>
                            <td>{{$item->fluide_frigorigene}}</td>
                            <td>{{$item->periodicite_ip}}</td>
                            <td>{{$item->periodicite_rq}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <script>
        const tr_ensemble = document.querySelectorAll("tr[data-toggle='listeensemble']");

        tr_ensemble.forEach((item) => {
            item.addEventListener("click", function(){
                const id = this.getAttribute("data-id");

                window.location = `${location.href}&displayEnsemble=${id}`
            })
        })
    </script>
    @endif

    @if (request()->has('displayEnsemble'))
        @include("profil_client_views.popup.detail_listemodele");
        <div class="card">
            <h2>Modèles associés : </h2>
            @if (count($listemodele) == 0)
            <p class="italic">Aucun modèle disponible, veuillez en créer au moins un.</p>
            @else
            @include("components.floatinginput", [
                "id" => "field_messites_searchmodele",
                "type" => "text",
                "placeholder" => "Rechercher parmi les ensembles",
                "classparent" => "mt-3"
            ])
            <table class="messite-table">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>Référence</th>
                        <th>Fabricant</th>
                        <th>DMES</th>
                        <th>Catégorie fluide frigorigène</th>
                        <th>Année</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listemodele as $item)
                        <tr data-toggle="listemodele" data-id="{{$item->id}}">
                            <td>{{$item->designation}}</td>
                            <td>{{$item->reference}}</td>
                            <td>{{$item->fabricant}}</td>
                            <td>{{$item->date_mes}}</td>
                            <td>{{$item->categorie_fluide_frigorigene}}</td>
                            <td>{{$item->annee}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <script>
            const _token = document.querySelector("meta[name='_token']").getAttribute("content");
            const tr_modele = document.querySelectorAll("tr[data-toggle='listemodele']");
            const detail_listemodele_container = document.querySelector(".detail-listemodele-container");

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


            function fetch_result(url, d){
                return fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-type" : "application/json"
                    },
                    body: JSON.stringify(d)
                }).then(response => {
                    return response.json();
                }).then(result => {
                    return result;
                }).catch(error => {
                    return error;
                });
            }

            tr_modele.forEach((item) => {
                item.addEventListener("click", async function(){
                    const id = this.getAttribute("data-id");
                    detail_listemodele_container.style.top = "0"

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
                })
            })
        </script>
    @endif
</div>