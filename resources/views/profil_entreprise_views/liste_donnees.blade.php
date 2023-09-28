<div class="profil-entreprise-container">
    <h2>Liste des données</h2>
    <div class="type-donnees-container">
        @for($i = 0; $i < 5 ; $i++)
            @include("profil_entreprise_views.components.card_actions", [
                "icon" => "bi-question-circle",
                "title" => "Test $i",
                "description" => "Description $i"
            ])
        @endfor
    </div>
</div>