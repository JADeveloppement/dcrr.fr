@php
    use App\Models\User;
    use App\Models\ListeModele;
    use App\Models\ListeSites;

    $userId = User::where("email", Cookie::get("dcrr_login"))->first()->id;

    if (request()->has('userId')) $userId = request()->userId;
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
@endphp
@include("profil_entreprise_views.popup.addmodele")
@include("profil_entreprise_views.popup.detail_listemodele")
<div class="modelesassocies">
    <div class="absolute top-[10px] right-[1rem] seemore_ensemble">
        <button class="btn-cancel text-sm">Réduire</button>
    </div>
    @if (!$sitefound->exists())
        <div class="flex w-full">
            <p class="mb-3 badge bg-danger text-[1rem]">Discordance entre site ({{$site_parent}}) et utilisateur ({{$userId}})</p>
        </div>
    @elseif (!$ensemblefound->exists())
        <div class="flex mb-3">
            <p class="mb-3 badge bg-danger text-[1rem]">Discordance entre ensemble ({{$ensemble}}) et utilisateur ({{$userId}})</p> 
        </div>
    @else
        <h2>Modèles associés à cet ensemble : </h2>
        <div class="w-full flex items-center justify-center">
            <table class="w-fit my-4 text-center">
                <thead class="bg-slate-700 text-white font-extrabold">
                    <tr>
                        <th class="p-4">Nature</th>
                        <th class="p-4">Désignation</th>
                        <th class="p-4">Complément référence</th>
                        <th class="p-4">Numéro de série</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-slate-200">
                        <td class="p-3 border-r-[1px] border-black">{{$ensemblefound->first()->data_nature->modele_nature}}</td>
                        <td class="p-3 border-r-[1px] border-black">{{$ensemblefound->first()->data_designation->modele_designation}}</td>
                        <td class="p-3 border-r-[1px] border-black">{{$ensemblefound->first()->data_reference->modele_reference}}</td>
                        <td class="p-3">{{$ensemblefound->first()->numero_de_serie}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @include("components.floatinginput", [
            "id" => "field_messites_searchmodele",
            "type" => "text",
            "placeholder" => "Rechercher parmi les ensembles",
            "classparent" => "mt-3"
        ])
        <button class="add-modele">Ajouter un modèle</button>
        @if ($listemodele->count() == 0)
            <p>Aucun modèle associé à cet ensemble, veuillez en rajouter un.</p>
        @else
            <table class="messite-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Nature</th>
                        <th>Designation</th>
                        <th>Référence</th>
                        <th>Fabricant</th>
                        <th>Date MES</th>
                        <th>Catégorie fluide frigorigène</th>
                        <th>Année</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listemodele as $item)
                        <tr data-toggle="listemodele" data-id="{{$item->id}}">
                            <td data-toggle="actionlistemodele">
                                <div data-toggle="actionlistemodele" class="flex items-center justify-center">
                                    <i data-toggle="actionlistemodele" data-action="listemodele_seemore" class="text-[1.5rem] mr-3 bi bi-search"></i>
                                    <i data-toggle="actionlistemodele" data-action="listemodele_edit" class="text-[1.5rem] mr-3 bi bi-pen"></i>
                                    <i data-toggle="actionlistemodele" data-action="listemodele_delete" class="text-[1.5rem] bi bi-trash"></i>
                                </div>
                            </td>
                            <td>{{ $item->nature }}</td>
                            <td>{{ $item->designation }}</td>
                            <td>{{ $item->reference }}</td>
                            <td>{{ $item->fabricant }}</td>
                            <td>{{ $item->date_mes }}</td>
                            <td>{{ $item->categorie_fluide_frigorigene }}</td>
                            <td>{{ $item->annee }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
<script src="{{asset('js/profil_entreprise_scripts/liste_modele.js')}}"></script>