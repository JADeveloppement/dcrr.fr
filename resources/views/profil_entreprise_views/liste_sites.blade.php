@php
    use App\Models\User;

    $user = User::find(User::where("email", Cookie::get("dcrr_login"))->first()->id);

    $listeSites = $user->listeSites;
@endphp

<div class="profil-entreprise-container">
    <h2>Liste des sites : 
        @if(isset($displaySite))
            <span class="badge bg-dcrr-green text-white font-extrabold ml-4">{{$displaySite}}</span>
        @endif
    </h2>
    <span class="italic">Cliquez sur une ligne pour afficher ses ensembles associés.</span>
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
                <tr>
                    <td>
                        <div class="flex items-center justify-center">
                            <i class="bi bi-search hover:text-dcrr-green cursor-pointer"></i>
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

    @if (request()->has('displaySite'))
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
    
    @if (request()->has('displayEnsemble'))
    <div class="modelesassocies">
        <div class="absolute top-[10px] right-[1rem] seemore_ensemble">
            <button class="btn-cancel text-sm">Réduire</button>
        </div>
        <h2>Ensemble associé : </h2>
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
        <h2>Liste des modèles associés</h2>
        <p class="italic">Aucun modèle disponible, veuillez en créer au moins un.</p>
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