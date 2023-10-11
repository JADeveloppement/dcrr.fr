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
    $listemodele = ListeModele::where("site_parent", $site_parent)
                                ->where("user_parent", $userId)
                                ->where("modele_parent", $ensemble)->get();
@endphp
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
                        <th>Code Client</th>
                        <th>Nom Client</th>
                        <th>Code Site</th>
                        <th>Nom Site</th>
                        <th>Marque</th>
                        <th>Date de Mise en service</th>
                        <th>Conformité</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 10; $i++)
                        <tr>
                            <td>
                                <div class="flex items-center justify-center">
                                    <i class="bi bi-search hover:text-dcrr-green cursor-pointer"></i>
                                </div>
                            </td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    @endif
</div>

<script>
    const btn_add_modele = document.querySelector(".add-modele");
    const popup_add_modele = document.querySelector(".popup-addmodele");

    btn_add_modele.addEventListener("click", function(){
        popup_add_modele.style.top = "0";
    })
</script>