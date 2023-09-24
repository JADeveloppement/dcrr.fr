<div class="profil-entreprise-container">
    <h2>Liste des utilisateurs</h2>
    <div class="w-full m-3 flex justify-between">
        @include("components.floatinginput", [
            "id" => "field_listeusers_filter",
            "type" => "text",
            "placeholder" => "Chercher un utilisateur"    
        ])

        <div class="flex items-center text-sm">
            Type d'affichage :
            <div class="flex m-3">
                <i class="bi bi-grid mr-3 bg-slate-700 text-white p-2 shadow-md rounded-lg"></i>
                <i class="bi bi-list p-2 shadow-md rounded-lg"></i>
            </div>
        </div>
    </div>

    <h3>Afficher selon le rôle</h3>
    <select name="" id="" class="form-select">
        <option value="">-- Afficher selon les rôles --</option>
        <option value="">Client</option>
        <option value="">Employés</option>
        <option value="">Administrateur</option>
    </select>

    <div class="liste-user-container user-card">
        @for($i = 0; $i < 10; $i++)
            <div class="card-user">
                <div class="title">
                    <h3>Utilisateur {{ $i }}</h3>
                    <div class="flex items-center">
                        <span class="badge text-sm bg-warning mr-3">Rôle</span>
                        <i class="bi bi-box-arrow-up-right cursor-pointer"></i>
                    </div>
                </div>
                <div class="body">
                    <p>E-mail : {{$i}}</p>
                    <p>Entreprise : {{$i}}</p>
                    <p>Rôle : {{$i}}</p>
                    <p>Newsletter : {{$i}}</p>
                </div>
                <div class="action">
                    <i class="bi bi-pen"></i>
                    <i class="bi bi-trash"></i>
                </div>
            </div>
        @endfor
    </div>

    <div class="user-list">
        <table class="w-full my-4 shadow-md">
            <thead>
                <tr class="bg-dcrr-green text-white font-extrabold">
                    <th class="text-left p-2 w-[45%]">Utilisateur</th>
                    <th class="text-center p-2 w-[45%]">Rôle</th>
                    <th class="text-right p-2 w-[10%]"></th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 10; $i++)
                    <tr class="p-2 border-solid border-[1px] border-b-slate-700">
                        <td class="text-left p-2 ">Utilisateur {{ $i }}</td>
                        <td class="text-center p-2 "><span class="badge text-sm bg-warning mr-3">Rôle</span></td>
                        <td class="text-right p-2 ">
                            <div class="flex items-center text-center">
                                <i class="mr-3 text-[1.2rem] w-full bi bi-search"></i>
                                <i class="mr-3 text-[1.2rem] w-full bi bi-pen"></i>
                                <i class="mr-3 text-[1.2rem] w-full bi bi-trash"></i>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>