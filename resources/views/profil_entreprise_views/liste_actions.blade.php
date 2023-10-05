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
    <h3>Actions utilisateurs</h3>
        <table class="w-full my-4 shadow-md">
            <thead>
                <tr class="bg-dcrr-green text-white">
                    <th class="text-center p-2"></th>
                    <th class="text-center p-2">Nom prénom</th>
                    <th class="text-center p-2">Email</th>
                    <th class="text-center p-2">Entreprise</th>
                    <th class="text-center p-2">Poste</th>
                    <th class="text-center p-2">Newsletter</th>
                    <th class="text-center p-2">Création</th>
                    <th class="text-center p-2">Role</th>
                    <th class="text-center p-2">Provenance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userToValide as $u)
                    <tr>
                        <td class="p-2">
                            <div class="flex items-center">
                                <i class="text-[1.5rem] bi bi-pen mr-4"></i>
                                <i class="text-[1.5rem] bi bi-trash mr-4"></i>
                            </div>
                        </td>
                        <td class="text-center p-2">{{$u->nomprenom}}</td>
                        <td class="text-center p-2">{{$u->email}}</td>
                        <td class="text-center p-2">{{$u->entreprise}}</td>
                        <td class="text-center p-2">{{$u->poste}}</td>
                        <td class="text-center p-2">{{$u->newsletter}}</td>
                        <td class="text-center p-2">{{$u->createdAt}}</td>
                        <td class="text-center p-2">{{$roles[$u->role]}}</td>
                        <td class="text-center p-2"><span class="badge bg-warning">Website</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>