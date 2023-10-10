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