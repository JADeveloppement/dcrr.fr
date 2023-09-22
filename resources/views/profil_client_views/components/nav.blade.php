<div class="nav" @if($requestMenu) style="top: -200vh;" @endif>
    <div class="close">
        <i class="bi bi-x-circle-fill"></i>
    </div>
    <div class="navmenus">
        @if(empty($navinfos))
            AUCUNE DONNEES RENSEIGNEES
        @else
            @foreach($navinfos as $key => $value)

                @include("components.navlinks", [
                    "icon" => $key,
                    "label" => $value,
                    "displayMenu" => $displayMenu,
                    "position" => array_search($key, array_keys($navinfos))
                ])

            @endforeach
        @endif
    </div>
</div>

<script>
    const nav = document.querySelector(".nav");
    const close_nav = document.querySelector(".nav > .close");

    close_nav.addEventListener("click", function(){
        nav.style.top = "-200vh";
    })
</script>