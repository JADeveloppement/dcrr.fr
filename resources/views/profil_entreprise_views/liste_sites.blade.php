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

    $listeSites = $user->listeSites;
@endphp

<div class="profil-entreprise-container">
    @include("profil_entreprise_views.popup.addsite")
    @include("profil_entreprise_views.popup.addensemble")


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

    @include("profil_entreprise_views.liste_site_views.liste_site")

    @if (request()->has('displaySite'))
        @include("profil_entreprise_views.liste_site_views.liste_ensemble")
    @endif
    
    @if (request()->has('displayEnsemble'))
        @include("profil_entreprise_views.liste_site_views.liste_modele")
    @endif
</div>