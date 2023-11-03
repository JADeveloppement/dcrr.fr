@php
    use App\Models\Marques;

    $liste_marque = Marques::get();

@endphp
<h2>Liste des marques</h2>
<div class="form-floating my-3" >
    <input type="text" class="form-control" id="listemarque_search" placeholder="Rechercher parmi les marques" >
    <label for="listemarque_search">
        <span class="bi bi-search mr-3"></span> Rechercher parmi les marques
     </label>
</div>
<table class="actiondonnees-table">
    <thead>
        <tr>
            <th>Action</th>
            <th>Donnée originale</th>
            <th>Nouvelle donnée</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($liste_marque as $marque)
            <tr data-toggle="listemarque_row" data-id="{{ $marque->id }}" data-value="{{ $marque->marque }}">
                <td>
                    <div class="flex items-center justify-center">
                        <i data-toggle="listemarque_action" data-action="edit" class="cursor-pointer text-[1.5rem] mr-3 bi bi-pen"></i>
                        <i data-toggle="listemarque_action" data-action="canceledit" class="cursor-pointer text-[1.5rem] mr-3 bi bi-x-square"></i>
                        <i data-toggle="listemarque_action" data-action="delete" class="cursor-pointer text-[1.5rem] mr-3 bi bi-trash"></i>
                    </div>
                </td>
                <td>{{ $marque->marque }}</td>
                <td>
                    @include('components.floatinginput', [
                        "id" => $marque->id,
                        "type" => "text",
                        "disabled" => "disabled",
                        "placeholder" => $marque->marque
                    ])
                </td>
            </tr>
        @endforeach
    </tbody>
</table>