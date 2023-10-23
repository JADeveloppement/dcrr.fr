@php
    use App\Models\Fluides;

    $liste_fluides = Fluides::get();

@endphp
<h2>Liste des fluides</h2>
<div class="form-floating my-3" >
    <input type="text" class="form-control" id="listefluides_search" placeholder="Rechercher parmi les fluides" >
    <label for="listefluides_search">
        <span class="bi bi-search mr-3"></span> Rechercher parmi les fluides
     </label>
</div>
<table class="actiondonnees-table">
    <thead>
        <tr>
            <th>Action</th>
            <th>Nom fluide</th>
            <th>Modification</th>
            <th>Classe sécurité</th>
            <th>Catégorie</th>
            <th>Toxique</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($liste_fluides as $fluide)
            <tr data-toggle="listefluides_row" data-id="{{ $fluide->id }}" data-value="{{ $fluide->nom_fluide }}">
                <td>
                    <div class="flex items-center justify-center">
                        <i data-toggle="listefluides_action" data-action="edit" class="cursor-pointer text-[1.5rem] mr-3 bi bi-pen"></i>
                        <i data-toggle="listefluides_action" data-action="canceledit" class="cursor-pointer text-[1.5rem] mr-3 bi bi-x-square"></i>
                        <i data-toggle="listefluides_action" data-action="delete" class="cursor-pointer text-[1.5rem] mr-3 bi bi-trash"></i>
                    </div>
                </td>
                <td>{{ $fluide->nom_fluide }}</td>
                <td>
                    @include('components.floatinginput', [
                        "id" => $fluide->id,
                        "type" => "text",
                        "disabled" => "disabled",
                        "placeholder" => $fluide->nom_fluide
                    ])
                </td>
                <td>
                    {{ $fluide->classe_securite }}
                </td>
                <td>
                    {{ $fluide->categorie }}
                </td>
                <td>
                    {{ $fluide->toxique }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>