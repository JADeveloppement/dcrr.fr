@php
    use App\Models\User;
    use App\Models\ListeActionUser;

    $listeuser = User::where("active", 0)->get();
    $listeactionuser = ListeActionUser::select("listeActionUsers.id as id", 
                                            "listeActionUsers.parentId as parentId", 
                                            "listeActionUsers.nomprenom as nomprenom", 
                                            "listeActionUsers.email as email", 
                                            "listeActionUsers.createdAt as createdAt", 
                                            "users.nomprenom as origine")
                                        ->join("users", "users.id","=", "listeActionUsers.actionFrom")
                                        ->get();
@endphp
@include("profil_entreprise_views.popup.detail_user_action")
<h2>Action sur les utilisateurs</h2>
<p>Cliquez sur une ligne pour avoir plus de détails</p>
<table class="actions-table">
    <thead>
        <tr>
            <td></td>
            <td>Action</td>
            <td>Nom PRENOM</td>
            <td>E-mail</td>
            <td>Date de demande</td>
            <td>Origine action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($listeuser as $u)
            <tr data-toggle='action-user' data-table="users" data-id="{{ $u->id }}">
                <td>
                    <div class="flex items-center justify-center">
                        <i data-id="{{$u->id}}" class="action-accept-actionuser text-[1.5rem] text-dcrr-green bi bi-check-circle mr-3"></i>
                        <i data-id="{{$u->id}}" class="action-delete-actionuser text-[1.5rem] text-red-600 bi bi-x-circle"></i>
                    </div>
                </td>
                <td>
                    <span class="badge bg-warning">Ajout</span>
                </td>
                <td>{{ $u->nomprenom }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->createdAt }}</td>
                <td>
                    <span class="badge bg-warning">Website</span>
                </td>
            </tr>
        @endforeach
        @foreach ($listeactionuser as $item)
            <tr data-toggle="action-user" data-table="listeactionusers" data-id="{{ $item->id }}">
                <td>
                    <div class="flex items-center justify-center">
                        <i data-id="{{$item->id}}" class="action-accept-actionuser text-[1.5rem] text-dcrr-green bi bi-check-circle mr-3"></i>
                        <i data-id="{{$item->id}}" class="action-delete-actionuser text-[1.5rem] text-red-600 bi bi-x-circle"></i>
                    </div>
                </td>
                <td></td>
                <td>{{$item->nomprenom}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->createdAt}}</td>
                <td>{{$item->origine}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ asset('js/profil_entreprise_scripts/actions_user.js') }}"></script>