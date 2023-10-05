@extends("master")

@php
    use App\Models\User;

    $displayMenu = 0;
    $requestMenu = false;
    if (request()->has('displayMenu')){
        $displayMenu = request()->displayMenu;
        $requestMenu = true;
    }

@endphp

@section('head')
    <link rel='stylesheet' href="{{ asset('css/profil_entreprise.css') }}">
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
@endsection

@section("content")
    @include("profil_entreprise_views.components.header")

    @if($displayMenu == 0)
        <!-- TODO : SCRIPT -->
        @include("profil_entreprise_views.mes_infos")
    @elseif($displayMenu == 1)
        <!-- TODO : SCRIPT -->
        @include("profil_entreprise_views.liste_sites", [
            "displaySite" => User::where("email", Cookie::get('dcrr_login'))->first()->id,
        ])
    @elseif($displayMenu == 2)
        <!-- TODO : SCRIPT -->
        @include("profil_entreprise_views.liste_users")
    @elseif($displayMenu == 3)
        <!-- TODO : SCRIPT -->
        @include("profil_entreprise_views.liste_sites")
    @elseif($displayMenu == 4)
        <!-- TODO : SCRIPT -->
        @include("profil_entreprise_views.liste_actions")
    @elseif($displayMenu == 5)
        <!-- TODO : SCRIPT -->
        @include("profil_entreprise_views.liste_donnees")
    @else 
        @include("profil_entreprise_views.error", [
            "title_error" => "Pas de page trouvée",
            "description_error" => "ID page : ".$displayMenu
        ])
    @endif
    
    @include("profil_entreprise_views.components.nav", [
        "displayMenu" => $displayMenu,
        "navinfos" => array_combine(["person-circle", "buildings empty", "person", "buildings", "key", "cone-striped", "power"], 
                                    ["Mon profil", "Mes sites", "Liste des utilisateurs", "Liste des sites", "Actions à valider", "Modifier les données", "Déconnexion"]),
        "requestMenu" => $requestMenu
    ])

    <script>
        const nav_menu = document.querySelector(".nav")
        const btn_menu = document.querySelector("header > .right > .menu-nav");

        btn_menu.addEventListener("click", function(){
            nav_menu.style.top = "0";
        });

        const btn_logout = document.querySelector("a[data-target='6']")
        btn_logout.addEventListener("click", function(e){
            e.preventDefault();
            window.location = "/signin";
        })
    </script>
@endsection