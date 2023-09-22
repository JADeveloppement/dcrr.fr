<a @if(!empty($position)) href="profil?displayMenu={{$position}}" @endif>
    <div class="navlinks @if(!empty($position)) @if(intval($displayMenu) == intval($position)) navlinks-actif @endif @endif @if(!empty($class)) {{$class}} @endif">
        <i class="bi @if(empty($icon)) bi-app @else bi-{{$icon}} @endif"></i>
        <span>@if(empty($label)) LABEL @else {{$label}} @endif</span>
    </div>
</a>