<div class="form-check @if(!empty($classparent)) {{$classparent}} @endif">
    <input class="form-check-input" type="checkbox" id="{{$id}}" @if(!empty($checked) && $checked) checked @endif>
    <label class="form-check-label" for="{{$id}}">@if(empty($label)) Champ à compléter @else {{$label}} @endif</label>
</div>
