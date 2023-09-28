@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
@endsection

@section("content")
    <div class="travel-bg">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
    </div>
    
    @include("components.login")
    @include("components.popup")
    <script src="{{asset('js/utils.js')}}"></script>
    <script src="{{asset('js/signin.js')}}"></script>
@endsection