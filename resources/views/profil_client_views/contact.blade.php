<div class="profil-client-container">
    <h2>Formulaire de contact</h2>
    @include("components.floatinginput", [
        "id" => "field_contact_objet",
        "type" => "text",
        "placeholder" => "Objet de votre demande"
    ])

    <div class="form-floating">
        <textarea class="form-control" placeholder="Votre message" id="field_contact_message" style="height: 300px" resize="false"></textarea>
        <label for="field_contact_message">Votre message</label>
    </div>

    <button class="btn-contact">Envoyer</button>
</div>