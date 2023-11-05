@php
    use App\Models\User;

    $user = User::where("email", Cookie::get("dcrr_login"))->first();
@endphp
@include("profil_client_views.popup.saveinfos")
<div class="profil-client-container">
    <h2>Mes informations personnelles</h2>
    @include("components.floatinginput", [
        "id" => "field_mesinfos_name",
        "type" => "text",
        "placeholder" => "Nom prénom",
        "classparent" => "mt-3 w-full",
        "value" => $user->nomprenom
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_email",
        "type" => "text",
        "placeholder" => "Email",
        "classparent" => "mt-3 w-full",
        "value" => $user->email
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_entreprise",
        "type" => "text",
        "placeholder" => "Dénomination entreprise",
        "classparent" => "mt-3 w-full",
        "value" => $user->entreprise
    ])

    @include("components.floatinginput", [
        "id" => "field_mesinfos_poste",
        "type" => "text",
        "placeholder" => "Poste dans l'entreprise",
        "classparent" => "mt-3 w-full",
        "value" => $user->poste
    ])

    @include("components.checkbutton", [
        "id" => "field_mesinfos_newsletter",
        "label" => "Inscription à la newsletter",
        "classparent" => "mt-3",
        "checked" => $user->newsletter 
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

<script>
    const field_mesinfos_name = document.querySelector("#field_mesinfos_name");
    const field_mesinfos_email = document.querySelector("#field_mesinfos_email");
    const field_mesinfos_entreprise = document.querySelector("#field_mesinfos_entreprise");
    const field_mesinfos_poste = document.querySelector("#field_mesinfos_poste");
    const field_mesinfos_newsletter = document.querySelector("#field_mesinfos_newsletter");

    const field_mesinfos_oldpassword = document.querySelector("#field_mesinfos_oldpassword");
    const field_mesinfos_newpassword = document.querySelector("#field_mesinfos_newpassword");
    const field_mesinfos_confirmpassword = document.querySelector("#field_mesinfos_confirmpassword");

    const save_mesinfos_infos = document.querySelector(".save-mesinfos-infos");
    const save_mesinfos_password = document.querySelector(".save-mesinfos-password");

    const saveinfos_container = document.querySelector(".saveinfos-container");

    save_mesinfos_infos.addEventListener("click", function(){
        field_mesinfos_name.value.length == 0 ? field_mesinfos_name.classList.add("is-invalid") : field_mesinfos_name.classList.remove("is-invalid");
        field_mesinfos_email.value.length == 0 ? field_mesinfos_email.classList.add("is-invalid") : field_mesinfos_email.classList.remove("is-invalid");
        field_mesinfos_entreprise.value.length == 0 ? field_mesinfos_entreprise.classList.add("is-invalid") : field_mesinfos_entreprise.classList.remove("is-invalid");
        field_mesinfos_poste.value.length == 0 ? field_mesinfos_poste.classList.add("is-invalid") : field_mesinfos_poste.classList.remove("is-invalid");

        if (!field_mesinfos_name.classList.contains("is-invalid") && !field_mesinfos_email.classList.contains("is-invalid") && !field_mesinfos_entreprise.classList.contains("is-invalid") && !field_mesinfos_poste.classList.contains("is-invalid")){
            saveinfos_container.style.top = "0";
        }
    })
</script>