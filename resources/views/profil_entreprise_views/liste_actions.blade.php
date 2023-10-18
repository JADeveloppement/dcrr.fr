@php
    use App\Models\User ;

    $userToValide = User::where("active", 0)->get();
    $roles = ["Client", "Employé", "Administrateur"];
@endphp
<div class="profil-entreprise-container">
    <h2>Liste des actions</h2>
    <span class="italic">Cliquez sur une carte pour afficher les actions en attente de validation</span>
    <div class="type-actions-container">
        <a href="?displayMenu=4&action=1">
            @include("profil_entreprise_views.components.card_actions", [
                "icon" => "bi-person-circle",
                "title" => "Utilisateurs",
                "description" => "Modification/Ajout d'utilisateurs",
                "actif" => request()->has("action") && request()->action == 1
            ])
        </a>

        <a href="?displayMenu=4&action=2">
            @include("profil_entreprise_views.components.card_actions", [
                "icon" => "bi-buildings",
                "title" => "Sites",
                "description" => "Modification/Ajout de site",
                "actif" => request()->has("action") && request()->action == 2
            ])
        </a>

        <a href="?displayMenu=4&action=3">
            @include("profil_entreprise_views.components.card_actions", [
                "icon" => "bi-buildings",
                "title" => "Modèles",
                "description" => "Modification/Ajout de modèles",
                "actif" => request()->has("action") && request()->action == 3
            ])
        </a>

        <a href="?displayMenu=4&action=4">
            @include("profil_entreprise_views.components.card_actions", [
                "icon" => "bi-database-fill-gear",
                "title" => "Données",
                "description" => "Modification/Ajout des données",
                "actif" => request()->has("action") && request()->action == 4
            ])
        </a>
    </div>
    <hr class="my-4">
    @if (request()->has("action") && request()->action == 1)
        <h2>Action sur les utilisateurs</h2>
    @elseif (request()->has("action") && request()->action == 2)
        <h2>Action sur les sites</h2>
    @elseif (request()->has("action") && request()->action == 3)
        <h2>Action sur les modèles</h2>
    @elseif (request()->has("action") && request()->action == 4)
        <h2>Modifier les données</h2>
        <div class="type-actions-container">
            <a href="?displayMenu=4&action=4&data=1">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Marques",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 1
                ])
            </a>
    
            <a href="?displayMenu=4&action=4&data=2">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Fluides frigorigènes",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 2
                ])
            </a>

            <a href="?displayMenu=4&action=4&data=3">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Types",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 3
                ])
            </a>

            <a href="?displayMenu=4&action=4&data=4">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Références",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 4
                ])
            </a>

            <a href="?displayMenu=4&action=4&data=5">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Nature",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 5
                ])
            </a>

            <a href="?displayMenu=4&action=4&data=6">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Fabricant",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 6
                ])
            </a>

            <a href="?displayMenu=4&action=4&data=7">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Désignations",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 7
                ])
            </a>

            <a href="?displayMenu=4&action=4&data=3">
                @include("profil_entreprise_views.components.card_actions", [
                    "icon" => "bi-gear",
                    "title" => "Données modèles",
                    "description" => "Modification/Ajout des données",
                    "actif" => request()->has("data") && request()->data == 8
                ])
            </a>
        </div>

    @endif

</div>