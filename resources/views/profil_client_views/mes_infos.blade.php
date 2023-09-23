@include("profil_client_views.popup.saveinfos")
<div class="profil-client-container">
    <h2>Mes informations personnelles</h2>
    @include("components.floatinginput", [
        "id" => "field_mesinfos_name",
        "type" => "text",
        "placeholder" => "Nom prénom",
        "classparent" => "mt-3 w-full"
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_email",
        "type" => "text",
        "placeholder" => "Email",
        "classparent" => "mt-3 w-full"
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_entreprise",
        "type" => "text",
        "placeholder" => "Dénomination entreprise",
        "classparent" => "mt-3 w-full"
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_poste",
        "type" => "text",
        "placeholder" => "Poste dans l'entreprise",
        "classparent" => "mt-3 w-full"
    ])

    @include("components.checkbutton", [
        "id" => "field_mesinfos_newsletter",
        "label" => "Inscription à la newsletter"
    ])

    <button class="save-mesinfos-infos">Enregistrer</button>

    <hr>
    <h2>Modifier votre mot de passe</h2>
    @include("components.floatinginput", [
        "id" => "field_mesinfos_oldpassword",
        "type" => "password",
        "placeholder" => "Ancien mot de passe",
        "classparent" => "mt-3 w-full"
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_newpassword",
        "type" => "password",
        "placeholder" => "Nouveau mot de passe",
        "classparent" => "mt-3 w-full"
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_confirmpassword",
        "type" => "password",
        "placeholder" => "Confirmation mot de passe",
        "classparent" => "mt-3 w-full"
    ])

    <button class="save-mesinfos-password">Enregistrer</button>
</div>