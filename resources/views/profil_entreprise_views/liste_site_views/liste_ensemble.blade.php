@php
    use App\Models\ListeModele;
    use App\Models\DataModeleType;
    use App\Models\ListeSites;

    $liste_ensemble = ListeModele::where("user_parent", intval($user->id))
                                ->where("site_parent", intval(request()->displaySite))
                                ->where("type", DataModeleType::where("modele_type", "Ensemble")->first()->id)
                                ->get();

    $site_selected = ListeSites::where("id", intval(request()->displaySite))
                        ->get();
    
    $ensemble_selected = 0;
    if (request()->has('displayEnsemble')) $ensemble_selected = request()->displayEnsemble;
@endphp
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
                    <th>Nature</th>
                    <th>Designation</th>
                    <th>Référence</th>
                    <th>Fabricant</th>
                    <th>Date de mise en service</th>
                    <th>Catégorie fluide frigorigène</th>
                    <th>Numéro de série</th>
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
                        <td>{{$i->data_nature->modele_nature}}</td>
                        <td>{{$i->data_designation->modele_designation}}</td>
                        <td>{{$i->data_reference->modele_reference}}</td>
                        <td>{{$i->data_fabricant->modele_fabricant}}</td>
                        <td>{{$i->date_mes}}</td>
                        <td>{{$i->categorie_fluide_frigorigene}}</td>
                        <td>{{$i->numero_de_serie}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{asset('js/profil_entreprise_scripts/liste_ensemble.js')}}"></script>