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
            "displaySite" => "XXXX"
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
    @else 
        <p>Autre menu</p>
    @endif
    
    @include("profil_entreprise_views.components.nav", [
        "displayMenu" => $displayMenu,
        "navinfos" => array_combine(["person-circle", "buildings empty", "person", "buildings", "key", "cone-striped", "power"], 
                                    ["Mon profil", "Mes sites", "Liste des utilsiateurs", "Liste des sites", "Actions à valider", "Modifier les données", "Déconnexion"]),
        "requestMenu" => $requestMenu
    ])

    <script>
        const nav_menu = document.querySelector(".nav")
        const btn_menu = document.querySelector("header > .right > .menu-nav");

        /*const btn_news = document.querySelector(".menu-news");
        const btn_notif = document.querySelector(".menu-notif");

        const notif_container = document.querySelector(".notif-container");
        const btn_close_notif = document.querySelector(".btn-close-notif");

        btn_close_notif.addEventListener("click", function(){
            notif_container.style.left = "-500px";
            //suite
        })

        const news_container = document.querySelector(".news-container");
        const btn_close_news = document.querySelector(".btn-close-news");

        btn_close_news.addEventListener("click", function(){
            news_container.style.right = "-500px";
        })

        btn_news.addEventListener("click", function(){
            news_container.style.right = "0px";
        })
        btn_notif.addEventListener("click", function(){
            notif_container.style.left = "0";
        })*/

        // const btn_logout = document.querySelector("a[data-target='4']")
        // btn_logout.addEventListener("click", function(e){
        //     e.preventDefault();
        //     window.location = "/signin";
        // })

        btn_menu.addEventListener("click", function(){
            nav_menu.style.top = "0";
        });
    </script>
@endsection