@php
    use App\Models\User;
    use App\Models\ListeSites;

    $user = User::where("email", Cookie::get("dcrr_login"))->first();
    $found = true;

    if (request()->has('userId') && intval(request()->userId)){
        if (User::where("id", intval(request()->userId))->exists())
            $user = User::where("id", intval(request()->userId))->first();
        else $found = false;
    }
    $userId = $user->id;
    $listeSites = ListeSites::select("listeSites.id as id", 
                                    "listeSites.code_client as code_client", 
                                    "listeSites.nom_client as nom_client", 
                                    "listeSites.code_site as code_site", 
                                    "listeSites.nom_site as nom_site")
                            ->where("proprietaire", $userId)
                            ->get();
@endphp

<div class="profil-entreprise-container">

    @if (!$found)
        <div class="card items-center">
            <span class="badge bg-dcrr-green text-white font-extrabold ml-4 text-2xl w-fit">Mes sites</span>
            <span class="badge bg-danger italic text-sm text-center mt-3">Aucun utilisateur trouvé pour l'ID sélectionné (ID : {{request()->userId}})</span>
        </div>
    @elseif(request()->has('userId'))
        <div class="card text-center items-center">
            @if (User::where("email", Cookie::get("dcrr_login"))->first()->id == intval(request()->userId))
                <span class="badge bg-dcrr-green text-white font-extrabold ml-4 text-2xl w-fit">Mes sites</span>
            @else
                <h2>Liste des sites de
                    <span class="badge bg-dcrr-green text-white font-extrabold ml-4">{{$user->nomprenom}}</span>
                </h2>
            @endif
        </div>
    @endif

    @include("profil_entreprise_views.liste_site_views.liste_site", [
        "listeSites" => $listeSites,
        "userId" => $userId,
    ])

    @if (request()->has('displaySite'))
        @include("profil_entreprise_views.liste_site_views.liste_ensemble", [
            "userId" => $userId,
        ])
    @endif

    @if (request()->has('displayEnsemble'))
        @include("profil_entreprise_views.liste_site_views.liste_modele", [
            "userId" => $userId,
            "site_parent" => intval(request()->displaySite),
            "ensemble_parent" => intval(request()->displayEnsemble)
        ])
    @endif
</div>