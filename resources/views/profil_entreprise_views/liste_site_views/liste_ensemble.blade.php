@php
    use App\Models\ListeModele;
    use App\Models\DataModeleType;
    use App\Models\ListeSites;
    
    $liste_ensemble = ListeModele::select("listeModele.id as id",
                                            "data_modele_nature.modele_nature as nature",
                                            "data_modele_reference.modele_reference as reference",
                                            "data_modele_designation.modele_designation as designation",
                                            "data_modele_fabricant.modele_fabricant as fabricant",
                                            "listeModele.date_mes as date_mes",
                                            "listeModele.categorie_fluide_frigorigene as categorie_fluide_frigorigene",
                                            "listeModele.numero_de_serie as numero_de_serie",
                                            "listeModele.user_parent as user_parent",
                                            "listeModele.site_parent as site_parent")
                                            // "liste_marques.marque as marque")
                                ->join("data_modele_nature","data_modele_nature.id", "=", "listeModele.nature")
                                ->join("data_modele_reference","data_modele_reference.id", "=", "listeModele.complement_reference")
                                ->join("data_modele_designation","data_modele_designation.id", "=", "listeModele.designation")
                                ->join("data_modele_fabricant","data_modele_fabricant.id", "=", "listeModele.fabricant")
                                // ->join("liste_marques","liste_marques.id", "=", "listeModele.marquename")
                                ->where("user_parent", intval($userId))
                                ->where("site_parent", intval(request()->displaySite))
                                ->where("type", DataModeleType::where("modele_type", "Ensemble")->first()->id)
                                ->get();

    $site_selected = ListeSites::select("id", "nom_client", "code_client", "nom_site", "code_site")
                        ->where("id", intval(request()->displaySite))
                        ->where("proprietaire", intval($userId))
                        ->get();
    
    $ensemble_selected = 0;
    if (request()->has('displayEnsemble')) $ensemble_selected = request()->displayEnsemble;
@endphp
@include("profil_entreprise_views.popup.addensemble")
<div class="card">
    <div class="ensemblesassocies">
        <div class="absolute top-[10px] right-[1rem] seemore_ensemble">
            <button class="btn-cancel text-sm">Réduire</button>
        </div>
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
                        <td class="p-3 border-r-[1px] border-black">{{$site_selected->first()->nom_client}}</td>
                        <td class="p-3 border-r-[1px] border-black">{{$site_selected->first()->code_client}}</td>
                        <td class="p-3 border-r-[1px] border-black">{{$site_selected->first()->nom_site}}</td>
                        <td class="p-3">{{$site_selected->first()->code_site}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2>Liste des ensembles</h2>
        <button class="btn-add-ensemble">Ajouter un ensemble</button>
        @include("components.floatinginput", [
            "id" => "field_messites_searchensemble",
            "type" => "text",
            "placeholder" => "Rechercher parmi les ensembles",
            "classparent" => "mt-3"
            ])
        <p class="italic @if($liste_ensemble->count() > 0) hidden @endif">Aucun ensemble disponible, veuillez en créer au moins un.</p>
        <span class="italic @if($liste_ensemble->count() == 0) hidden @endif">Cliquez sur une ligne pour afficher ses ensembles associés.</span>
        <table class="messite-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <!-- <th>Nature</th> 
                    <th>Designation</th>
                    <th>Référence</th>
                    <th>Fabricant</th>
                    <th>Date de mise en service</th>
                    <th>Catégorie fluide frigorigène</th>
                    <th>Numéro de série</th>-->
                    <th>Marque</th>
                    <th>Désignation</th>
                    <th>Date de mise en service</th>
                    <th>Fluide frigorigène</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($liste_ensemble as $i)
                    <tr class="@if($i->id == $ensemble_selected) bg-dcrr-green/50 font-extrabold @endif" data-toggle="ensemble" data-id="{{$i->id}}" data-userparent="{{$i->user_parent}}" data-siteparent="{{$i->site_parent}}">
                        <td data-toggle="action" class="data-action">
                            <div class="data-action flex items-center justify-center">
                                <i class="data-action text-[1.5rem] bi bi-pen mr-3"></i>
                                <i class="data-action text-[1.5rem] bi bi-trash mr-3"></i>
                            </div>
                        </td>
                        <!--<td>{{$i->nature}}</td>
                        <td>{{$i->designation}}</td>
                        <td>{{$i->reference}}</td>
                        <td>{{$i->fabricant}}</td>
                        <td>{{$i->date_mes}}</td>
                        <td>{{$i->categorie_fluide_frigorigene}}</td>
                        <td>{{$i->numero_de_serie}}</td>-->
                        <td><span class="badge bg-secondary">NC</span></td>
                        <td>{{$i->designation}}</td>
                        <td>{{$i->date_mes}}</td>
                        <td>{{$i->categorie_fluide_frigorigene}}</td>
                        <td>
                            <div class="flex items-center justify-center">
                                <i class="text-[1.5rem] bi bi-info-circle"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/profil_entreprise_scripts/liste_ensemble.js')}}"></script>