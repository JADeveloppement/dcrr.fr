import {fetch_result, toggleButtonClick, do_popup} from "./utils.js";

/**
 * ONLY FRONT END
 */
const travel_img = document.querySelector(".travel-bg");
let left = -100;

function left_img(){
    let img = document.createElement("img");
    img.src = "/storage/img/bglogin.jpg";
    img.classList.add("signin-img");
    travel_img.appendChild(img);
    travel_img.appendChild(img);

    left -= 100;
    travel_img.style.left = left +"vw";
}

left_img();

setInterval(left_img, 300000);
/** */

const _token = document.querySelector("meta[name='_token']").getAttribute("content");

const field_signinemail = document.querySelector("#field_signinemail");
const field_signinpassword = document.querySelector("#field_signinpassword");
const field_signinnomprenom = document.querySelector("#field_signinnomprenom");
const field_signinentreprise = document.querySelector("#field_signinentreprise");
const field_signinposte = document.querySelector("#field_signinposte");
const field_signtermes = document.querySelector("#field_signtermes");
const field_signnewsletter = document.querySelector("#field_signnewsletter");
const field_signintelephone = document.querySelector("#field_signintelephone");

const btn_dosignin = document.querySelector(".btn-dosignin");

const btn_dologin = document.querySelector(".do-login");
const field_loginlogin = document.querySelector("#field_loginlogin");
const field_loginpassword = document.querySelector("#field_loginpassword");

btn_dosignin.addEventListener("click", async function(){
    const signinemail = field_signinemail.value;
    const signinpassword = field_signinpassword.value;
    const signinnomprenom = field_signinnomprenom.value;
    const signinentreprise = field_signinentreprise.value;
    const signinposte = field_signinposte.value;
    const signtermes = field_signtermes.checked;
    const signnewsletter = field_signnewsletter.checked;
    const signintelephone = field_signintelephone.value;
    const initialContent = this.innerText;

    signinemail.length == 0 ? field_signinemail.classList.add("is-invalid") : field_signinemail.classList.remove("is-invalid");
    signinpassword.length < 6 ? field_signinpassword.classList.add("is-invalid") : field_signinpassword.classList.remove("is-invalid");
    signinnomprenom.length == 0 ? field_signinnomprenom.classList.add("is-invalid") : field_signinnomprenom.classList.remove("is-invalid");
    signinentreprise.length == 0 ? field_signinentreprise.classList.add("is-invalid") : field_signinentreprise.classList.remove("is-invalid");
    signinposte.length == 0 ? field_signinposte.classList.add("is-invalid") : field_signinposte.classList.remove("is-invalid");
    field_signtermes.checked ? field_signtermes.classList.remove("is-invalid") : field_signtermes.classList.add("is-invalid");
    signintelephone.length < 10 ? field_signintelephone.classList.add("is-invalid") : field_signintelephone.classList.remove("is-invalid");
    
    let news = 0;
    signnewsletter ? news = 1 : news = 0;

    if (
        !field_signinemail.classList.contains("is-invalid") &&
        !field_signinpassword.classList.contains("is-invalid") &&
        !field_signinnomprenom.classList.contains("is-invalid") &&
        !field_signinentreprise.classList.contains("is-invalid") &&
        !field_signinposte.classList.contains("is-invalid") &&
        !field_signtermes.classList.contains("is-invalid") &&
        !field_signintelephone.classList.contains("is-invalid")
    ) {
        const data = {
            _token: _token,
            nomprenom: signinnomprenom,  
            email: signinemail,
            password: signinpassword,  
            entreprise: signinentreprise,  
            poste: signinposte,
            newsletter: news,
            telephone: signintelephone
        }

        toggleButtonClick(this, 1, "");

        try {
            toggleButtonClick(this, -1, initialContent);

            const result = await fetch_result("/do_signin", data);                    
            if (result.r !== true){
                if (result.r == -1) do_popup ("bg-orange-500", "bi-info-circle", "E-mail déjà utilisée.");
            } 
            else if (result.r) do_popup ("bg-dcrr-green", "bi-info-circle", "Inscription effectuée.");;
        } catch(error){
            do_popup ("bg-red-500", "bi-x-circle", "ERREUR : "+e);
        }
    }

})

btn_dologin.addEventListener("click", async function(){
    const initialContent = this.innerText;

    const login = field_loginlogin.value;
    const password = field_loginpassword.value;

    login.length == 0 ? field_loginlogin.classList.add("is-invalid") : field_loginlogin.classList.remove("is-invalid");
    password.length == 0 ? field_loginpassword.classList.add("is-invalid") : field_loginpassword.classList.remove("is-invalid");

    if (!field_loginlogin.classList.contains("is-invalid") && !field_loginpassword.classList.contains("is-invalid")){
        const data = {
            _token: _token,
            login: login,
            password: password
        }

        toggleButtonClick(this, 1, "");


        try {
            const result = await fetch_result("/do_login", data);
            toggleButtonClick(this, -1, initialContent);

            switch(result.r){
                case -3:
                    do_popup ("bg-orange-500", "bi-info-circle", "Mauvais identifiant ou mot de passe.");
                    break;
                case -2:
                    do_popup ("bg-orange-500", "bi-info-circle", "Votre compte n'a pas encore été activé.");
                    break;
                case -1:
                    do_popup ("bg-orange-500", "bi-info-circle", "Mauvais identifiant ou mot de passe.");
                    break;
                case 0:
                    do_popup ("bg-red-500", "bi-x-circle", "Une erreur est survenue, veuillez réessayer.");
                    break;
                default:
                    do_popup ("bg-dcrr-green", "bi-info-circle", "Bienvenue  "+result.r);
                    break;
            }
        } catch(error){
            do_popup ("bg-red-500", "bi-x-circle", "ERREUR : "+error);
        }
    }
})