<select class="form-select @if(!empty($class)) {{ $class }} @endif" name="{{ $name }}" id="{{ $id }}">
    <option value="0">
        @if (empty($first_value))
        --- Données ---
        @else
        {{ $first_value }}
        @endif
    </option>
    @foreach($key as $k)
        @if (empty($k))
        <option value="">--</option>
        @else
        <option value="{{ $k }}">{{ $k }}</option>
        @endif
    @endforeach
</select>