@php
    use App\Models\User;

    $user = User::where("email", Cookie::get("dcrr_login"))->first();
    $found = true;

    if (request()->has('userId') && intval(request()->userId)){
        if (User::where("id", intval(request()->userId))->exists())
            $user = User::where("id", intval(request()->userId))->first();
        else $found = false;
    }

    $listeSites = $user->listeSites;
@endphp

<div class="profil-entreprise-container">
    @include("profil_entreprise_views.popup.addsite")


    @if (!$found)
        <div class="card items-center">
            <span class="badge bg-dcrr-green text-white font-extrabold ml-4 text-2xl w-fit">Mes sites</span>
            <span class="badge bg-danger italic text-sm text-center mt-3">Aucun utilisateur trouvé pour l'ID sélectionné (ID : {{request()->userId}})</span>
        </div>
    @elseif(request()->has('userId'))
        <div class="card text-center items-center">
            @if (User::where("email", Cookie::get("dcrr_login"))->first()->id == intval(request()->userId))
                <span class="badge bg-dcrr-green text-white font-extrabold ml-4 text-2xl w-fit">Mes sites</span>
            @else
                <h2>Liste des sites de
                    <span class="badge bg-dcrr-green text-white font-extrabold ml-4">{{$user->nomprenom}}</span>
                </h2>
            @endif
        </div>
    @endif

    <div class="card">
        <h2>Liste des sites</h2>
        <span class="italic">Cliquez sur une ligne pour afficher ses ensembles associés.</span>
        <div class="flex">
            <button class="add-site">Ajouter un site</button>
        </div>
        <i class="@if($listeSites->count() > 0) hidden @endif">Liste des sites vide, veuillez en ajouter au moins un seul.</i>
        <table class="messite-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Code Client</th>
                    <th>Nom Client</th>
                    <th>Code Site</th>
                    <th>Nom Site</th>
                    <th>Marque</th>
                    <th>Date de Mise en service</th>
                    <th>Conformité</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listeSites as $l)
                    <tr data-target="site" data-site="{{$l->id}}" @if(request()->has('displaySite') && request()->displaySite == $l->id) class="font-extrabold bg-dcrr-green/50" @endif>
                        <td>
                            <div class="flex items-center justify-center text-[1.5rem]">
                                <i class="site-action bi bi-pen mr-3 hover:text-dcrr-green cursor-pointer" data-toggle="edit" data-id="{{$l->id}}"></i>
                                <i class="site-action bi bi-trash hover:text-dcrr-green cursor-pointer" data-toggle="delete" data-id="{{$l->id}}"></i>
                            </div>
                        </td>
                        <td>{{ $l->code_client }}</td>
                        <td>{{ $l->nom_client }}</td>
                        <td>{{ $l->code_site }}</td>
                        <td>{{ $l->nom_site }}</td>
                        <td>{{ $l->marque->marque }}</td>
                        <td>{{ $l->date_mise_en_service }}</td>
                        <td>{{ $l->conforme }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script>
        const add_site = document.querySelector(".add-site");
        const popup_add_site = document.querySelector(".popup-addsite");

        add_site.addEventListener("click", function(){
            popup_add_site.style.top = "0";
        })

        const row_site = document.querySelectorAll("tr[data-target='site']");
        const row_site_action = document.querySelectorAll(".site-action");

        row_site_action.forEach((t) => {
            t.addEventListener("click", function(){
                const id = this.getAttribute("data-id");
                const action = this.getAttribute("data-toggle");

                if (action == "delete"){
                    console.log("delete");
                } else if (action == "edit"){
                    console.log("edit");
                }
            })
        })
        row_site.forEach((t) =>  {
            t.addEventListener("click", function(e){
                const urlParams = new URLSearchParams(window.location.search);
                const params = {};

                urlParams.forEach((value, key) => {
                    params[key] = value;
                });

                const id = this.getAttribute("data-site");
                if (e.target.classList.contains("site-action")) e.preventDefault();
                else {
                    window.location="?displayMenu=1&userId="+params.userId+"&displaySite="+id;
                } 
            })
        })
    </script>

    @if (request()->has('displaySite'))
    <div class="card">
        <div class="ensemblesassocies">
            <div class="absolute top-[10px] right-[1rem] seemore_ensemble">
                <button class="btn-cancel text-sm">Réduire</button>
            </div>
            <div class="w-full flex items-center justify-center">
                <table class="w-fit my-4 text-center">
                    <thead class="bg-slate-700 text-white font-extrabold">
                        <tr>
                            <th class="p-4">Nom Client</th>
                            <th class="p-4">Code Client</th>
                            <th class="p-4">Nom Site</th>
                            <th class="p-4">Code Site</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-slate-200">
                            <td class="p-3 border-r-[1px] border-black">XXXX</td>
                            <td class="p-3 border-r-[1px] border-black">XXXX</td>
                            <td class="p-3 border-r-[1px] border-black">XXXX</td>
                            <td class="p-3">XXXX</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h2>Liste des ensembles</h2>
            <p class="italic">Aucun ensemble disponible, veuillez en créer au moins un.</p>
            @include("components.floatinginput", [
                "id" => "field_messites_searchensemble",
                "type" => "text",
                "placeholder" => "Rechercher parmi les ensembles",
                "classparent" => "mt-3"
            ])
            <table class="messite-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Code Client</th>
                        <th>Nom Client</th>
                        <th>Code Site</th>
                        <th>Nom Site</th>
                        <th>Marque</th>
                        <th>Date de Mise en service</th>
                        <th>Conformité</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 10; $i++)
                        <tr data-target="ensemble" data-ensemble="{{$i}}" data-id="" @if(request()->has('displayEnsemble') && request()->displayEnsemble == $l->id) class="font-extrabold bg-dcrr-green/50" @endif>
                            <td>
                                <div class="flex items-center justify-center">
                                    <i class="bi bi-search hover:text-dcrr-green cursor-pointer"></i>
                                </div>
                            </td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                            <td>Lorem</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const row_ensemble = document.querySelectorAll("tr[data-target='ensemble']");

        row_ensemble.forEach((r) => {
            r.addEventListener("click", function(e){
                const urlParams = new URLSearchParams(window.location.search);
                const params = {};

                urlParams.forEach((value, key) => {
                    params[key] = value;
                });

                const id = this.getAttribute("data-ensemble");
                if (e.target.classList.contains("site-action")) e.preventDefault();
                else window.location="?displayMenu=1&userId"+params.userId+"&displaySite="+params.displaySite+"&displayEnsemble="+id;
            })
        })
    </script>
    @endif
    
    @if (request()->has('displayEnsemble'))
    <div class="modelesassocies">
        <div class="absolute top-[10px] right-[1rem] seemore_ensemble">
            <button class="btn-cancel text-sm">Réduire</button>
        </div>
        <h2>Modèles associés à cet ensemble : </h2>
        <div class="w-full flex items-center justify-center">
            <table class="w-fit my-4 text-center">
                <thead class="bg-slate-700 text-white font-extrabold">
                    <tr>
                        <th class="p-4">Nature</th>
                        <th class="p-4">Désignation</th>
                        <th class="p-4">Complément référence</th>
                        <th class="p-4">Numéro de série</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-slate-200">
                        <td class="p-3 border-r-[1px] border-black">XXXX</td>
                        <td class="p-3 border-r-[1px] border-black">XXXX</td>
                        <td class="p-3 border-r-[1px] border-black">XXXX</td>
                        <td class="p-3">XXXX</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="italic">Aucun ensemble disponible, veuillez en créer au moins un.</p>
        @include("components.floatinginput", [
            "id" => "field_messites_searchmodele",
            "type" => "text",
            "placeholder" => "Rechercher parmi les ensembles",
            "classparent" => "mt-3"
        ])
        <table class="messite-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Code Client</th>
                    <th>Nom Client</th>
                    <th>Code Site</th>
                    <th>Nom Site</th>
                    <th>Marque</th>
                    <th>Date de Mise en service</th>
                    <th>Conformité</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 10; $i++)
                    <tr>
                        <td>
                            <div class="flex items-center justify-center">
                                <i class="bi bi-search hover:text-dcrr-green cursor-pointer"></i>
                            </div>
                        </td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                        <td>Lorem</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    @endif
</div>