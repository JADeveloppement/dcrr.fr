<div class="profil-entreprise-container">
    <h2>Liste des actions</h2>
    <span class="italic">Cliquez sur une carte pour afficher les actions en attente de validation</span>
    <div class="type-actions-container">
        @for($i = 0; $i < 5 ; $i++)
            @include("profil_entreprise_views.components.card_actions", [
                "icon" => "bi-question-circle",
                "title" => "Test $i",
                "description" => "Description $i"
            ])
        @endfor
    </div>
    <hr class="my-4">
    <p>Liste des actions à valider</p>
</div>