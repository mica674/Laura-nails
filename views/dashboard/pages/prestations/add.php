<!-- MAIN -->
<main>
    <?= Flash::flash() ?? ''; ?>
    <!-- Client profil form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="prestaAddForm">
            <fieldset class="loginFieldset">
                <h2>Ajouter une prestation</h2>
            </fieldset>
            <!-- Name -->
            <label for="name" class="mt-2">Nom <span class="isRequired">*</span></label>
            <input type="text" name="name" id="name" class="inputForm" placeholder="Nom (ex: Pose vernis couleur)" required value="<?= $name ?? '' ?>" pattern="<?= REGEXP_TITLE ?>">
            <small <?= ($error['name'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['name'] ?? '' ?></small>
            <!-- Description REQUIRED -->
            <label for="descriptionMain" class="mt-2">Description principale <span class="isRequired">*</span></label>
            <input type="text" name="descriptionMain" id="descriptionMain" class="inputForm" placeholder="Description (ex: Pour des ongles parfaitement vernis)" required value="<?= $descriptionMain ?? '' ?>" pattern="<?= REGEXP_DESCRIPTION ?>">
            <small <?= ($error['descriptionMain'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['descriptionMain'] ?? '' ?></small>
            <!-- Description OPTIONAL -->
            <label for="descriptionOptional" class="mt-2">Description optionnelle</label>
            <input type="text" name="descriptionOptional" id="descriptionOptional" class="inputForm" placeholder="Description optionnelle (ex: Une pose de vernis parfaite)" value="<?= $descriptionOptional ?? '' ?>" pattern="<?= REGEXP_DESCRIPTION ?>">
            <small <?= ($error['descriptionOptional'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['descriptionOptional'] ?? '' ?></small>
            <!-- Duration -->
            <label for="duration" class="mt-2">Durée (en minutes)<span class="isRequired">*</span></label>
            <input type="number" name="duration" id="duration" class="inputForm" placeholder="Durée en minutes (ex: 75)" required value="<?= $duration ?? '' ?>" pattern="<?= REGEXP_PRICE ?>">
            <small <?= ($error['duration'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['duration'] ?? '' ?></small>
            <!-- Price -->
            <label for="price" class="mt-2">Prix (en €) <span class="isRequired">*</span></label>
            <input type="text" name="price" id="price" class="inputForm" placeholder="Prix (ex: 18)" required value="<?= $price ?? '' ?>" pattern="<?= REGEXP_PRICE ?>">
            <small <?= ($error['price'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['price'] ?? '' ?></small>

            <!-- Required fields informations -->
            <small class="registrationSmall me-5 mt-3"><span class="isRequired">*</span> Champs obligatoires pour ajouter une prestation</small>

            <!-- Button to registrer -->
            <div class="prestaAddBtns mt-2">
                <button class="prestaAddBtn" id="prestaAddBtn">Ajouter</button>
            </div>
        </form>
    </div>
</main>
<!-- MAIN end -->