<div class="container @if(!empty($class)) {{$class}} @endif" @if(!empty($type)) style="top: 0;" @else style="top: -100vh;" @endif>
        <div class="box">
            @yield("popup")
        </div>
    </div>
</div>