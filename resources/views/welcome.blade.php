@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
@endsection

@section("content")

    <div class="screen-loading">
        <span class="spinner spinner-border text-light loading"></span>
        <img class="logo-first-loading" src="{{ asset('storage/img/logo_white.png') }}">
        <div class="barre-horizontale" style=""></div>
    </div>

    <div class="index-screen">
        <img class="bg-fond" src="{{ asset('storage/img/bg_fond.png') }}" alt="">
        <img src="{{ asset('storage/img/logo_white.png') }}" alt="">

        <a href="/signin">
            <button class="text-[1.2rem]">Rejoignez-nous</button>
        </a>
        <h3 class="badge bg-dcrr-green/50 text-white text-[1.2rem]">Et choisissez la date de votre intervention maintenant !</h3>
    </div>


    <a href="/signin">Se connecter</a>
    <script type='text/javascript' src="{{ asset('js/index.js') }}" ></script>
@endsection