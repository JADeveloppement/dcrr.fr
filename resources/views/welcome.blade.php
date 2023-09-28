@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
@endsection

@section("content")

    <div class="screen-loading flex w-full h-screen fixed z-[100] items-center justify-center bg-black" style="left: 0; top: 0; transition: all 1.5s ease-out;">
        <span class="spinner spinner-border text-light w-[100px] h-[100px] loading absolute z-[101]"></span>
        <img class="logo-first-loading absolute z-[102] bg-black" src="{{ asset('storage/img/logo_white.png') }}" style="opacity: 0; transition: opacity 2s ease-out;">
        <div class="absolute z-[101] h-[4px] left-0 bg-dcrr-green barre-horizontale" style="width: 0px; transition: width 2s ease-out;"></div>
    </div>

    <div class="flex flex-col items-center justify-center w-full h-screen relative bg-black/10">
        <img class="w-full h-screen object-cover fixed z-[-1] top-0 left-0" src="{{ asset('storage/img/bg_fond.png') }}" alt="">
        <img src="{{ asset('storage/img/logo_white.png') }}" alt="">

        <a href="/signin">
            <button class="text-[1.2rem]">Rejoignez-nous</button>
        </a>
        <h3 class="badge bg-dcrr-green/50 text-white text-[1.2rem]">Et choisissez la date de votre intervention maintenant !</h3>
    </div>


    <a href="/signin">Se connecter</a>
    <script type='text/javascript' src="{{ asset('js/index.js') }}" ></script>
@endsection