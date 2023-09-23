@extends("master")

@php
    $displayMenu = 0;
    $requestMenu = false;
    if (request()->has('displayMenu')){
        $displayMenu = request()->displayMenu;
        $requestMenu = true;
    }

@endphp

@section('head')
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
@endsection

@section("content")
    @include("profil_client_views.components.header")

    @if($displayMenu == 0)
        <!-- TODO : SCRIPT -->
        @include("profil_client_views.mes_infos")
    @elseif($displayMenu == 1)
        <!-- TODO : LISTE ENSEMBLE 
                    LISTE SITE
                    SCRIPTS -->
        @include("profil_client_views.mes_sites")
    @elseif($displayMenu == 2)
        <!-- TODO : EVERYTHING -->
        @include("profil_client_views.boutique")
    @else
        <p>Autre menu</p>
    @endif
    
    @include("profil_client_views.components.nav", [
        "displayMenu" => $displayMenu,
        "navinfos" => array_combine(["person-circle", "buildings", "shop", "envelope", "power"], 
                                    ["Mon profil", "Mes sites", "Boutique", "Contact", "Deconnexion"]),
        "requestMenu" => $requestMenu
    ])

    <script>
        const nav_menu = document.querySelector(".nav")
        const btn_menu = document.querySelector("header > .right > .menu-nav");

        btn_menu.addEventListener("click", function(){
            nav_menu.style.top = "0";
        });
    </script>
@endsection