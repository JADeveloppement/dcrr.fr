<div class="form-floating @if (!empty($classparent)) {{ $classparent }} @endif" >
    <input 
        type="{{ $type }}" 
        class="form-control @if (!empty($class)) {{ $class }} @endif"
        id="{{ $id }}"
        @if (empty($value)) placeholder="{{ $placeholder }}" @endif 
        @if (!empty($disabled)) {{ $disabled }} @endif
        @if (!empty($value)) value="{{ $value }}" @endif
        @if (!empty($more_param)) 
        @php foreach($more_param as $key => $value)
        echo $key."=".$value." ";
        @endphp
        @endif
    >
    <label for="{{ $id }}">
        @if (empty($placeholder))
            Champs
        @else
            {{ $placeholder }}
        @endif
     </label>
</div>