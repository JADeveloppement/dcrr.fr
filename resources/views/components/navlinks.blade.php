<a href="profil?displayMenu={{$position}}">
    <div class="navlinks @if(intval($displayMenu) == intval($position)) navlinks-actif @endif">
        <i class="bi @if(empty($icon)) bi-app @else bi-{{$icon}} @endif"></i>
        <span>@if(empty($label)) LABEL @else {{$label}} @endif</span>
    </div>
</a>