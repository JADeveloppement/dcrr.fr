@php
    use App\Models\Marques;
    use App\Models\Fluides;
    use App\Models\User;

    $proprio = User::where("email", Cookie::get("dcrr_login"))->first()->nomprenom;
    $id_proprio = User::where("email", Cookie::get("dcrr_login"))->first()->id;

    if (request()->has('userId')){
        if (User::where("id", request()->userId)->exists()){
            $proprio = User::where("id", request()->userId)->first()->nomprenom;
            $id_proprio = User::where("id", request()->userId)->first()->id;
        }
    }

@endphp
<div class="container justify-start popup-addsite" style="top: -100vh;">
    <div class="box relative">
        <h2>Ajouter un site</h2>
        <div class="flex w-full justify-start mb-3">
            @include("components.floatinginput", [
                "id" => "field_addsite_nomclient",
                "type" => "text",
                "placeholder" => "Nom Client",
                "classparent" => "w-full mr-3",
            ])
            @include("components.floatinginput", [
                "id" => "field_addsite_codeclient",
                "type" => "text",
                "placeholder" => "Code client",
                "classparent" => "w-full"
            ])
        </div>
        <div class="flex w-full justify-start mb-3">
            @include("components.floatinginput", [
                "id" => "field_addsite_nomsite",
                "type" => "text",
                "placeholder" => "Nom site",
                "classparent" => "w-full mr-3",
            ])
            @include("components.floatinginput", [
                "id" => "field_addsite_codesite",
                "type" => "text",
                "placeholder" => "Code site",
                "classparent" => "w-full"
            ])
        </div>

        <div class="flex w-full justify-start mb-3">
            <select class="form-select mr-3" class="mb-3" name="" id="">
                <option value="0">-- Choisissez une marque --</option>
                @foreach (Marques::get() as $m)
                    <option value="{{$m->id}}">{{$m->marque}}</option>
                @endforeach
            </select>
    
            <select class="form-select" name="" id="">
                <option value="0">-- Choisissez un fluide frigorigène --</option>
                @foreach (Fluides::get() as $f)
                    <option value="{{$f->id}}">{{$f->nom_fluide}}</option>
                @endforeach
            </select>
        </div>

        <div class="flex w-full justify-start mb-3">
            @include("components.floatinginput", [
                "id" => "field_addsite_date_mise_en_service",
                "type" => "text",
                "placeholder" => "Date de mise en service",
                "classparent" => "w-full mr-3"
            ])

            @include("components.floatinginput", [
                "id" => "field_addsite_designation",
                "type" => "text",
                "placeholder" => "Désignation",
                "classparent" => "w-full"
            ])
        </div>

        <div class="flex w-full justify-start mb-3">
            @include("components.checkbutton", [
                "id" => "field_addsite_conforme",
                "label" => "Appareil conforme",
                "classparent" => "w-full"
            ])
        </div>
        
        @include("components.floatinginput", [
            "id" => "field_addsite_proprietaire",
            "type" => "text",
            "placeholder" => $proprio." (".$id_proprio.")",
            "classparent" => "w-full",
            "disabled" => "disabled"
        ])

        <button class="btn-save-addsite w-full" data-target="{{$id_proprio}}">Enregistrer</button>
        <button class="btn-cancel btn-close-addsite">Annuler</button>
    </div>
</div>

<script>
    const btn_close_save_mesinfos = document.querySelector(".btn-close-addsite");
    const popup_save_infos_container = document.querySelector(".popup-addsite");

    btn_close_save_mesinfos.addEventListener("click", function(){
        popup_save_infos_container.style.top = "-100vh";
    })

</script>