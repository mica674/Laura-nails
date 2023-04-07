<!-- MAIN -->
<main>
    <!-- Client profil form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="commentEditForm">
            <fieldset class="commentFieldset">
                <h2>Modifier un commentaire</h2>
            </fieldset>
            <!-- Title -->
            <label for="title" class="mt-2">Titre <span class="isRequired">*</span></label>
            <input type="text" name="title" id="title" class="inputForm inputJS" placeholder="Titre de l'avis" required value="<?= $comment->title ?>" pattern="<?= REGEXP_TITLE ?>">
            <small <?= ($error['title'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['title'] ?? '' ?></small>
            <!-- Message -->
            <label for="message" class="mt-2">L'avis <span class="isRequired">*</span></label>
            <textarea name="message" class="rounded inputJS" id="message" cols="30" rows="10" maxlength="500" placeholder="Donnez votre avis ici... (500 caractères maximum)"><?= $message ?? $comment->content ?></textarea>
            <small <?= ($error['message'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['message'] ?? '' ?></small>
            <!-- Quotations -->
            <label for="quotations" class="mt-2">Note <span class="isRequired">*</span> (sur 5)</label>
            <input type="number" name="quotations" id="quotations" class="inputForm inputJS" placeholder="Durée en minutes (ex: 75)" required value="<?= $comment->quotations ?>" min="1" max="5">
            <small <?= ($error['quotations'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['quotations'] ?? '' ?></small>

            <!-- Required fields informations -->
            <small class="registrationSmall mt-3 mx-auto"><span class="isRequired">*</span> Champs obligatoires pour enregistrer la modification du commentaire</small>

            <!-- Button to registrer -->
            <div class="commentEditBtns mt-2">
                <input type="submit" class="commentEditBtn d-none" id="commentEditBtn" value="Enregistrer">
            </div>
        </form>
    </div>
</main>
<!-- MAIN end -->