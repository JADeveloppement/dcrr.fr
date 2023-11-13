@php
    use App\Models\User;

    $user = new User;
    $user_infos = $user->where("email", Cookie::get('dcrr_login'))->first();
@endphp
@include("profil_entreprise_views.popup.saveinfos")
<div class="profil-entreprise-container">
    <div class="card">
        <h2>Mes informations personnelles</h2>
        @include("components.floatinginput", [
            "id" => "field_mesinfos_name",
            "type" => "text",
            "placeholder" => "Nom prénom",
            "classparent" => "mt-3 w-full",
            "value" => $user_infos->nomprenom
        ])

        @include("components.floatinginput", [
            "id" => "field_mesinfos_email",
            "type" => "text",
            "placeholder" => "Email",
            "classparent" => "mt-3 w-full",
            "value" => $user_infos->email
        ])

        @include("components.floatinginput", [
            "id" => "field_mesinfos_entreprise",
            "type" => "text",
            "placeholder" => "Dénomination entreprise",
            "classparent" => "mt-3 w-full",
            "value" => $user_infos->entreprise
        ])

        @include("components.floatinginput", [
            "id" => "field_mesinfos_poste",
            "type" => "text",
            "placeholder" => "Poste dans l'entreprise",
            "classparent" => "mt-3 w-full",
            "value" => $user_infos->poste
        ])

        @include("components.checkbutton", [
            "id" => "field_mesinfos_newsletter",
            "label" => "Inscription à la newsletter",
            "checked" => intval($user_infos->newsletter)
        ])

        <button class="save-mesinfos-infos">Enregistrer</button>
    </div>

    <div class="card">
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
</div>
<script src="{{ asset('js/mes_infos.js') }}"></script>