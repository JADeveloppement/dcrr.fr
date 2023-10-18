<div class="card-actions @if(isset($actif) && $actif) action-actif @endif">
    <div class="left">
        @if(isset($icon))
            <i class="bi {{$icon}}"></i>
        @else
            <span class="badge bg-danger font-extrabold">
                <i class="bi bi-question-circle"></i>
            </span>
        @endif
    </div>
    <div class="right">
        <div class="title">
            <h2>
                @if(isset($title))
                    {{ $title }}
                @else
                    <span class="badge bg-danger font-extrabold">NO_TITLE</span>
                @endif
            </h2>
        </div>
        <div class="description">
            @if(isset($description))
                    {{ $description }}
                @else
                    <span class="badge bg-danger font-extrabold">NO_DESCRIPTION</span>
                @endif
        </div>
    </div>
</div>