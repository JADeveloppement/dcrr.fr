@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
@endsection

@section("content")

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