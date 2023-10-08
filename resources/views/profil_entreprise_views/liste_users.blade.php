@php
    use App\Models\User;
    use App\Models\DataRole;

    $roles = DataRole::get();
@endphp
<div class="profil-entreprise-container">
    <h2>Liste des utilisateurs</h2>
    <div class="card flex flex-col items-center">
        <h3 class="w-full text-left">Recherche par champs : </h3>
        <div class="w-full m-3 flex justify-between">
            @include("components.floatinginput", [
                "id" => "field_listeusers_filter",
                "type" => "text",
                "placeholder" => "Chercher un utilisateur",
                "classparent" => "w-full mr-3 ",
            ])

            <div class="flex items-center text-sm">
                Type d'affichage :
                <div class="flex ">
                    <i class="displaygrid cursor-pointer bi bi-grid mr-3 p-2 shadow-md rounded-lg sm-btn-active"></i>
                    <i class="displaylist cursor-pointer bi bi-list p-2 shadow-md rounded-lg"></i>
                </div>
            </div>
        </div>
        <h3 class="w-full text-left">Filtre selon les rôles : </h3>
        <select name="" id="" class="form-select">
            <option value="">-- Afficher selon les rôles --</option>
            @foreach ($roles as $r)
                @if (!empty($r->value))
                    <option value="{{$r->id}}">{{$r->value}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="card usergrid">
        <div class="liste-user-container user-card">
            @php
                $list_user = User::get();
            @endphp
            @foreach ($list_user as $user)
                <div class="card-user @if($user->active == 0) opacity-50 cursor-not-allowed @else cursor-pointer @endif">
                    <div class="title">
                        <h3>{{ $user->nomprenom }}</h3>
                        <span class="badge text-sm bg-warning mr-3"> {{$user->data_role->value}}</span>
                    </div>
                    <div class="body">
                        <div>
                            <p><b>E-mail : </b>{{$user->email}}</p>
                            <p><b>Entreprise : </b>{{$user->entreprise}}</p>
                            <p><b>Rôle : </b>{{$user->poste}}</p>
                            <p><b>Newsletter : </b>{{$user->newsletter}}</p>
                        </div>
                        <div class="m-1 p-2 flex items-center justify-center">
                            <a href="?displayMenu=1&userId={{$user->id}}">
                                <button>Voir les sites</button>
                            </a>
                        </div>
                    </div>
                    <div class="action">
                        <i class="bi bi-pen"></i>
                        <i class="bi bi-trash"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card userlist hidden">
        <div class="user-list">
            <table class="w-full my-4 shadow-md">
                <thead>
                    <tr class="bg-dcrr-green text-white font-extrabold">
                        <th class="text-left">Utilisateur</th>
                        <th class="text-center">Rôle</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Sites</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_user as $user)
                        <tr class="p-2 border-solid border-[1px] border-b-slate-700 @if($user->active == 0) opacity-50 bg-red-200 @endif">
                            <td class="text-left">{{$user->nomprenom}}</td>
                            <td class="text-center">
                                <span class="badge text-sm bg-warning mr-3">{{$user->data_role->value}}</span></td>
                            <td class="text-center">{{$user->email}}</td>
                            <td class="text-center">
                                <a href="?displayMenu=1&displaySite={{$user->id}}">
                                    <button class="bi bi-buildings"></button>
                                </a>
                            </td>
                            <td class="text-right">
                                <div class="flex items-center text-center">
                                    <i class="mr-3 text-[1.2rem] w-full bi bi-pen"></i>
                                    <i class="mr-3 text-[1.2rem] w-full bi bi-trash"></i>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const display_grid = document.querySelector(".displaygrid")
    const display_list = document.querySelector(".displaylist")

    const cardgrid = document.querySelector(".usergrid")
    const cardlist = document.querySelector(".userlist")

    display_grid.addEventListener("click", function(){
        console.log("ok");
        if (!this.classList.contains("sm-btn-active")){
            this.classList.add("sm-btn-active");
            display_list.classList.remove("sm-btn-active")
            cardlist.classList.add("hidden");
            cardgrid.classList.remove("hidden");
        }
    })
    display_list.addEventListener("click", function(){
        console.log("okok")
        if (!this.classList.contains("sm-btn-active")){
            display_grid.classList.remove("sm-btn-active")
            this.classList.add("sm-btn-active");
            cardgrid.classList.add("hidden");
            cardlist.classList.remove("hidden");
        }
    })
</script>