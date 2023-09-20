@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
@endsection

@section("content")

    <a href="/signin">Se connecter</a>
    <script type='text/javascript' src="{{ asset('js/index.js') }}" ></script>
@endsection