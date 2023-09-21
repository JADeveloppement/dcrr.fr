@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
@endsection

@section("content")
    <div class="travel-bg">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
    </div>
    
    @include("components.login")

    <script>
        const travel_img = document.querySelector(".travel-bg");
        const img = "<img class='signin-img' src='//localhost:3000/storage/img/bglogin.jpg' alt=''>";
        let left = -100;
        console.log(travel_img.firstElementChild);

        function left_img(){
            let img = document.createElement("img");
            img.src = "/storage/img/bglogin.jpg";
            img.classList.add("signin-img");
            travel_img.appendChild(img);
            travel_img.appendChild(img);

            left -= 100;
            travel_img.style.left = left +"vw";
        }

        left_img();

        setInterval(left_img, 300000);
    </script>
@endsection