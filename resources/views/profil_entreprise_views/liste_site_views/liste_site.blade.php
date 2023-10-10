@php
    use App\Models\User;
    use App\Models\ListeSites;

    $userId = User::where("email", Cookie::get("dcrr_login"))->first()->id;

    if (request()->has('userId')){
        $userId = request()->userId;
    }

    $listeSites = ListeSites::where("proprietaire", $userId)->get();
    
@endphp
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
<script src="{{asset('js/profil_entreprise_scripts/liste_site.js')}}"></script>