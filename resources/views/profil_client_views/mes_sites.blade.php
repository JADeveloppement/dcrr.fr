<div class="profil-client-container">
    <h2>Mes sites</h2>
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

    <div class="ensemblesassocies">
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
        
    </div>
</div>