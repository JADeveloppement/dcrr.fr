<a @if(isset($position)) href="profil?displayMenu={{$position}}" @endif>
    <div class="navlinks @if(isset($position) && intval($displayMenu) == intval($position)) navlinks-actif @endif @if(!empty($class)) {{$class}} @endif">
        <i class="bi @if(empty($icon)) bi-app @else bi-{{$icon}} @endif"></i>
        <span>@if(empty($label)) LABEL @else {{$label}} @endif</span>
    </div>
</a>