<div class="profil-entreprise-container">
    <div class="card">
        <h2>Liste des données</h2>
        <div class="type-donnees-container">
            <div class="type-actions-container">
                <a href="?displayMenu=5&action=1">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Marques",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 1
                    ]) 
                </a>
        
                <a href="?displayMenu=5&action=2">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Fluides frigorigènes",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 2
                    ])
                </a>

                <a href="?displayMenu=5&action=3">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Types",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 3
                    ])
                </a>

                <a href="?displayMenu=5&action=4">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Références",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 4
                    ])
                </a>

                <a href="?displayMenu=5&action=5">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Nature",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 5
                    ])
                </a>

                <a href="?displayMenu=5&action=6">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Fabricant",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 6
                    ])
                </a>

                <a href="?displayMenu=5&action=7">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Désignations",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 7
                    ])
                </a>

                <a href="?displayMenu=5&action=8">
                    @include("profil_entreprise_views.components.card_actions", [
                        "icon" => "bi-gear",
                        "title" => "Données modèles",
                        "description" => "Modification/Ajout des données",
                        "actif" => request()->has("action") && request()->action == 8
                    ])
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="card">
        @if (!request()->has('action'))
            <h2>Sélectionnez une carte pour effectuer une action</h2>
        @else
            @switch(request()->action)
                @case(1)
                    <h2>Liste des marques</h2>
                @break
                @case(2)
                    <h2>Liste des fluides frigorigènes</h2>
                @break
                @case(3)
                    <h2>Liste des Types</h2>
                @break
                @case(4)
                    <h2>Liste des Références</h2>
                @break
                @case(5)
                    <h2>Liste des Natures</h2>
                @break
                @case(6)
                    <h2>Liste des fabricant</h2>
                @break
                @case(7)
                    <h2>Liste des désignations</h2>
                @break
                @case(8)
                    <h2>Liste des données des modèles</h2>
                @break
                @default
                    <span class="badge bg-orange-600 text-xl">Action non reconnue</span>
                @break
            @endswitch
        @endif
    </div>
</div>