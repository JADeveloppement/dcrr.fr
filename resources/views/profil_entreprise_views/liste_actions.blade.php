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
    </div>
    <hr class="my-4">
    @if (request()->has("action") && request()->action == 1)
        <div class="card">
            @include("profil_entreprise_views.liste_action_views.actions_user")
        </div>
    @elseif (request()->has("action") && request()->action == 2)
        <div class="card">
            <h2>Action sur les sites</h2>
        </div>
    @elseif (request()->has("action") && request()->action == 3)
        <div class="card">
            <h2>Action sur les modèles</h2>
        </div>    
    @endif
</div>