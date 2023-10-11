@php
    use App\Models\Marques;
    use App\Models\Fluides;
    use App\Models\User;
    use App\Models\DataModeleType;
    use App\Models\DataModele;

@endphp
<div class="container justify-start popup-addmodele" style="top: -100vh;">
    <div class="box relative">
        <div class="close-addmodel btn-close-addmodele">
            <i class="bi bi-x text-[1.5rem]"></i>
        </div>
        <div class="flex">
            <div class="left">
                <h2 class="mb-3">Ajouter un modèle</h2>
                <p class="mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 1 - Type de modèle</p>
                <p class="mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 2 - Modèle correspondant</p>
                <p class="mb-2"><span class="bi bi-lock mr-3"></span><span class="bi bi-arrow-right mr-3"></span>Etape 3 - Récapitulatif</p>
            </div>
            <div class="right">
                <div class="etape" data-toggle="etape1">
                    <h2>Type de modèle</h2>
                    <div class="addmodele_listetype">
                        @foreach (DataModeleType::get() as $item)
                            <p>{{$item->modele_type}}</p>
                        @endforeach
                    </div>
                    <button class="nextetape" data-target='etape2' disabled="true">Valider</button>
                </div>
                <div class="etape" data-toggle="etape2">
                    <h2>Modèle correspondant</h2>
                    <div class="addmodele_listemodele">
                        
                    </div>
                    <button class="nextetape" data-target='etape3' disabled>Valider</button>
                </div>
                <div class="etape" data-toggle="etape3">
                    <h2>Récapitulatif</h2>
                    <button class="save-addmodele">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const btn_close_addmodele = document.querySelector(".btn-close-addmodele");
    const popup_addmodele = document.querySelector(".popup-addmodele");

    btn_close_addmodele.addEventListener("click", function(){
        popup_addmodele.style.top = "-100vh";
    })

    const btn_nextetape_to2 = document.querySelector(".nextetape[data-target='etape2']");
    const btn_nextetape_to3 = document.querySelector(".nextetape[data-target='etape3']");
    const etape1_choice = document.querySelectorAll(".addmodele_listetype > p");
    let LAST_TYPE_CLICKED = null, TYPE_CHOSEN = "";
    etape1_choice.forEach((item) => {
        item.addEventListener("click", function(){
            if (LAST_TYPE_CLICKED !== null && LAST_TYPE_CLICKED !== this){
                LAST_TYPE_CLICKED.classList.remove("actif")
            }
            if (!this.classList.contains("actif")){
                this.classList.add("actif")
                TYPE_CHOSEN = this.innerText;
                btn_nextetape_to2.removeAttribute("disabled");
            }
            else{
                this.classList.remove("actif");
                if (LAST_TYPE_CLICKED == this) btn_nextetape_to2.setAttribute("disabled", "true");
            }
            LAST_TYPE_CLICKED = this;
        })
    })

    btn_nextetape_to2.addEventListener("click", function(){
        fetch("/get_liste_modele", {
            method: "POST",
            headers: {
                "Content-type":"application/json"
            },
            body: JSON.stringify({_token: _token, type: TYPE_CHOSEN})
        }).then(result => {
            return result.json();
        }).then(result => {
            console.log(result);
        }).catch(error => {
            console.log(error);
        })
    })

</script>