<div class="container justify-start detail-useraction-container" style="top: -100vh;">
    <div class="box relative">
        <h2>Detail de l'action</h2>
        <table class="actionuser-table">
            <thead>
                <tr>
                    <th>Données</th>
                    <th>Originale</th>
                    <th>Modification</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nom Prénom</td>
                    <td class="detail_user_action_nomprenom"></td>
                    <td class="detail_user_action_nomprenom_mod"></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td class="detail_user_action_email"></td>
                    <td class="detail_user_action_email_mod"></td>
                </tr>
                <tr>
                    <td>Numéro de téléphone</td>
                    <td class="detail_user_action_telephone"></td>
                    <td class="detail_user_action_telephone_mod"></td>
                </tr>
                <tr>
                    <td>Dénomination entreprise</td>
                    <td class="detail_user_action_entreprise"></td>
                    <td class="detail_user_action_entreprise_mod"></td>
                </tr>
                <tr>
                    <td>Poste</td>
                    <td class="detail_user_action_poste"></td>
                    <td class="detail_user_action_poste_mod"></td>
                </tr>
                <tr>
                    <td>Newsletter</td>
                    <td class="detail_user_action_newsletter"></td>
                    <td class="detail_user_action_newsletter_mod"></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td class="detail_user_action_role"></td>
                    <td class="detail_user_action_role_mod"></td>
                </tr>
                <tr>
                    <td>Compte actif</td>
                    <td class="detail_user_action_active"></td>
                    <td class="detail_user_action_active_mod"></td>
                </tr>
                <tr>
                    <td>Date de création</td>
                    <td class="detail_user_action_createdAt"></td>
                    <td class="detail_user_action_createdAt_mod"></td>
                </tr>
            </tbody>
        </table>
        <button class="btn-cancel btn-close-detailaction">Fermer</button>
    </div>
</div>

<script>
    const btn_close_close_detailaction = document.querySelector(".btn-close-detailaction");
    const popup_detailaction_container = document.querySelector(".detail-useraction-container");

    btn_close_close_detailaction.addEventListener("click", function(){
        popup_detailaction_container.style.top = "-100vh";
    })
</script>