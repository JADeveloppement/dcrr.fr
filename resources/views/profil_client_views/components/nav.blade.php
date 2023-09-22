<div class="nav">
    <div class="close">
        <i class="bi bi-x-circle-fill"></i>
    </div>
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