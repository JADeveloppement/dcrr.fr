@php
    use App\Models\User ;

    $userToValide = User::where("active", 0)->get();
    $roles = ["Client", "Employé", "Administrateur"];
@endphp
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
    @foreach($userToValide as $u)
        <hr>
        <p>{{$u->nomprenom}}</p>
        <p>{{$u->email}}</p>
        <p>{{$u->entreprise}}</p>
        <p>{{$u->poste}}</p>
        <p>{{$u->newsletter}}</p>
        <p>{{$u->createdAt}}</p>
        <p>{{$roles[$u->role]}}</p>
    @endforeach
</div>