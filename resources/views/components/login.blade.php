<div class="container login-container" style="top: 0vh;">
    <div class="box">
        <h2>Connexion</h2>

        @include("components.floatinginput", [
            "id" => "field_signinlogin",
            "type" => "text",
            "placeholder" => "Identifiant",
            "classparent" => "mt-3"
        ])
        @include("components.floatinginput", [
            "id" => "field_signinpassword",
            "type" => "password",
            "placeholder" => "Mot de passe"
        ])
        <span class="btn-signin">Vous n'avez pas de compte ? Inscrivez-vous.</span>
        <button>Connexion</button>
    </div>
</div>

<div class="container signin-container" style="top: -100vh;">
    <div class="box">
        <h2>Inscription</h2>

        @include("components.floatinginput", [
            "id" => "field_signinemail",
            "type" => "text",
            "placeholder" => "E-mail",
            "classparent" => "w-full mt-3"
        ])
        @include("components.floatinginput", [
            "id" => "field_signinpassword",
            "type" => "password",
            "placeholder" => "Mot de passe",
            "classparent" => "w-full mt-3"
        ])

        @include("components.floatinginput", [
            "id" => "field_signinnomprenom",
            "type" => "name",
            "placeholder" => "NOM et Prénom",
            "classparent" => "w-full mt-3"
        ])
        @include("components.floatinginput", [
            "id" => "field_signinentreprise",
            "type" => "text",
            "placeholder" => "Dénomination Entreprise",
            "classparent" => "w-full mt-3"
        ])
        @include("components.floatinginput", [
            "id" => "field_signinposte",
            "type" => "text",
            "placeholder" => "Poste au sein de l'entreprise",
            "classparent" => "w-full mt-3"
        ])
        @include("components.checkbutton", [
            "id" => "field_signtermes",
            "label" => "En créant ce compte, j’accepte les éléments suivants : politique de confidentialité et conditions d’utilisation",
            "classparent" => "w-full mt-3"
        ])
        @include("components.checkbutton", [
            "id" => "field_signnewsletter",
            "label" => "Je consens à recevoir des E-mail à but marketing de l’Entreprise DCRR.",
            "classparent" => "w-full mt-3"
        ])
        <span class="btn-login">Vous avez déjà un compte ? Connectez-vous.</span>
        <button>S'inscrire</button>
    </div>
</div>

<script>
    const login_container = document.querySelector(".login-container");
    const signin_container = document.querySelector(".signin-container");
    const btn_login = document.querySelector(".btn-login");
    const btn_signin = document.querySelector(".btn-signin");

    btn_signin.addEventListener("click", function(){
        login_container.style.top = "-100vh";
        signin_container.style.top = "0vh";
    })
    
    btn_login.addEventListener("click", function(){
        signin_container.style.top = "-100vh";
        login_container.style.top = "0vh";
    })
</script>