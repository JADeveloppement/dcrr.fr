<div class="container justify-start detail-listemodele-container" style="top: -100vh;">
    <div class="box relative">
        <h2>Détail du modèle</h2>
        <div class="flex w-full p-4 items-center justify-center listemodele_loading">
            <span class='spinner spinner-border text-slate-400'></span>
        </div>
        <table class="popuplistemodele-table hidden">
            <thead>
                <tr>
                    <th>Données</th>
                    <th>Valeurs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Type</td>
                    <td class="detailistemodele_type"></td>
                </tr>
                <tr>
                    <td>Nature</td>
                    <td class="detailistemodele_nature"></td>
                </tr>
                <tr>
                    <td>Désignation</td>
                    <td class="detailistemodele_designation"></td>
                </tr>
                <tr>
                    <td>Complément référence</td>
                    <td class="detailistemodele_reference"></td>
                </tr>
                <tr>
                    <td>Fabricant</td>
                    <td class="detailistemodele_fabricant"></td>
                </tr>
                <tr>
                    <td>Volume</td>
                    <td class="detailistemodele_volume"></td>
                </tr>
                <tr>
                    <td>Diamètre Nominal</td>
                    <td class="detailistemodele_diametrenominal"></td>
                </tr>
                <tr>
                    <td>PMAX Constructeur</td>
                    <td class="detailistemodele_pmaxc"></td>
                </tr>
                <tr>
                    <td>PMIN Constructeur</td>
                    <td class="detailistemodele_pminc"></td>
                </tr>
                <tr>
                    <td>PMAX Réel</td>
                    <td class="detailistemodele_pmaxr"></td>
                </tr>
                <tr>
                    <td>PMIN Réel</td>
                    <td class="detailistemodele_pminr"></td>
                </tr>
                <tr>
                    <td>P Référence</td>
                    <td class="detailistemodele_ptarage"></td>
                </tr>
                <tr>
                    <td>TMAX Constructeur</td>
                    <td class="detailistemodele_tmaxc"></td>
                </tr>
                <tr>
                    <td>TMIN Constructeur</td>
                    <td class="detailistemodele_tminc"></td>
                </tr>
                <tr>
                    <td>TMAX Réel</td>
                    <td class="detailistemodele_tmaxr"></td>
                </tr>
                <tr>
                    <td>TMIN Réel</td>
                    <td class="detailistemodele_tminr"></td>
                </tr>
                <tr>
                    <td>Catégorie Fluide frigorigène</td>
                    <td class="detailistemodele_categorieff"></td>
                </tr>
                <tr>
                    <td>Catégorie de risque</td>
                    <td class="detailistemodele_catderisque"></td>
                </tr>
                <tr>
                    <td>Numéro de série</td>
                    <td class="detailistemodele_numerodeserie"></td>
                </tr>
                <tr>
                    <td>Année</td>
                    <td class="detailistemodele_annee"></td>
                </tr>
                <tr>
                    <td>Chapitre</td>
                    <td class="detailistemodele_chapitre"></td>
                </tr>
                <tr>
                    <td>Périodicité inspection</td>
                    <td class="detailistemodele_periodiciteinspection"></td>
                </tr>
            </tbody>
        </table>
        <div class="flex w-full items-center justify-center">
            <button class="btn-cancel btn-close-detailmodele">Fermer</button>
        </div>
    </div>
</div>

<script>
    const popup_detail_listemodele = document.querySelector(".detail-listemodele-container");
    const cancel_listemodele_popup = document.querySelector(".btn-close-detailmodele");
    const popup_listemodele_loading = document.querySelector(".listemodele_loading")
    const popup_listemodele_table = document.querySelector(".popuplistemodele-table");

    cancel_listemodele_popup.addEventListener("click", function(){
        popup_detail_listemodele.style.top = "-100vh" ;
        popup_listemodele_loading.classList.remove("hidden");
        popup_listemodele_table.classList.add("hidden");
    })
</script>