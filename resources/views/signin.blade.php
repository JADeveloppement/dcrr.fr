@extends("master")

@section("head")
    <link rel='stylesheet' href="{{ asset('css/index.css') }}">
    <link rel='stylesheet' href="{{ asset('css/global.css') }}">
@endsection

@section("content")
    <div class="travel-bg">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
        <img class="signin-img" src="/storage/img/bglogin.jpg" alt="">
    </div>
    
    @include("components.login")

    <script>
        const travel_img = document.querySelector(".travel-bg");
        const img = "<img class='signin-img' src='//localhost:3000/storage/img/bglogin.jpg' alt=''>";
        let left = -100;
        console.log(travel_img.firstElementChild);

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

        /** INSCRIPTION */
        const _token = document.querySelector("meta[name='_token']").getAttribute("content");
        const badge_spinner = "<span class='spinner spinner-border'></span>";

        function fetch_result(url, d){
            return fetch(url, {
                method: "POST",
                headers: {
                    "Content-type" : "application/json"
                },
                body: JSON.stringify(d)
            }).then(response => {
                return response.json();
            }).then(result => {
                return result;
            }).catch(error => {
                return error;
            });
        }

        function toggleButtonClick(target, c, initialContent){
            if (c == 1){
                target.innerHTML = badge_spinner;
                target.style.opacity = "0.7";
            } else if (c == -1){
                target.innerHTML = initialContent;
                target.style.opacity = "1";
            }
        }

        const field_signinemail = document.querySelector("#field_signinemail");
        const field_signinpassword = document.querySelector("#field_signinpassword");
        const field_signinnomprenom = document.querySelector("#field_signinnomprenom");
        const field_signinentreprise = document.querySelector("#field_signinentreprise");
        const field_signinposte = document.querySelector("#field_signinposte");
        const field_signtermes = document.querySelector("#field_signtermes");
        const field_signnewsletter = document.querySelector("#field_signnewsletter");
        const field_signintelephone = document.querySelector("#field_signintelephone");

        const btn_dosignin = document.querySelector(".btn-dosignin");

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
                        if (result.r == -1) console.log("Email déjà utilisée.");
                    } 
                    else if (result.r) console.log("Inscription effectuée.");
                } catch(error){
                    console.log(error);
                }
            }

        })

        const btn_dologin = document.querySelector(".do-login");
        const field_loginlogin = document.querySelector("#field_loginlogin");
        const field_loginpassword = document.querySelector("#field_loginpassword");

        btn_dologin.addEventListener("click", async function(){
            const initialContent = this.innerText;
            toggleButtonClick(this, 1, "");

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

                try {
                    const result = await fetch_result("/do_login", data);
                    toggleButtonClick(this, -1, initialContent);

                    switch(result.r){
                        case -3:
                            console.log("Mauvais utilisateur ou mot de passe");
                            break;
                        case -2:
                            console.log("Compte non actif");
                            break;
                        case -1:
                            console.log("Mauvais utilisateur ou mot de passe");
                            break;
                        case 0:
                            console.log("Une erreur est survenue, veuillez réessayer.");
                            break;
                        default:
                            console.log(result.r);
                            break;
                    }
                } catch(error){
                    console.log(error);
                }
            }
        })
        /** */
    </script>
@endsection