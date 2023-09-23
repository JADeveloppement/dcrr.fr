<div class="container justify-start saveinfos-container" style="top: -100vh;">
    <div class="box relative">
        <h2>Confirmation mot de passe</h2>
        <p class="w-full my-4 text-left">Un administrateur devra valider vos modifiations au préalable. <br>Vous serez notifié lorsque les modifications auront été acceptées.</p>
        @include("components.floatinginput", [
            "id" => "field_mesinfos_password",
            "type" => "password",
            "placeholder" => "Ancien mot de passe",
            "classparent" => "mt-3 w-full"
        ])
        <button class="btn-save-mesinfos w-full">Enregistrer</button>
        <button class="btn-cancel btn-close-mesinfos">Annuler</button>
    </div>
</div>