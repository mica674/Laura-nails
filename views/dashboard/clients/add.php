<!-- MAIN -->
<main>
    <?= Flash::flash() ?? ''; ?>
    <!-- Client profil form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="registrationForm">
            <fieldset class="loginFieldset">
                <h2>Ajouter un client</h2>
            </fieldset>
            <!-- Lastname -->
            <label for="lastname" class="mt-2">Nom <span class="registrationRequired">*</span></label>
            <input type="text" name="lastname" id="lastname" class="inputForm" placeholder="Nom (ex: Maurouard)" required autocomplete="family-name" value="<?= $lastname ?? '' ?>" pattern="<?= REGEXP_LASTNAME ?>">
            <small <?= ($error['lastname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['lastname'] ?? '' ?></small>
            <!-- Firstname -->
            <label for="firstname" class="mt-2">Prénom <span class="registrationRequired">*</span></label>
            <input type="text" name="firstname" id="firstname" class="inputForm" placeholder="Prénom (ex: Laura)" required autocomplete="given-name" value="<?= $firstname ?? '' ?>" pattern="<?= REGEXP_FIRSTNAME ?>">
            <small <?= ($error['firstname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['firstname'] ?? '' ?></small>
            <!-- Email -->
            <label for="email" class="mt-2">E-mail <span class="registrationRequired">*</span></label>
            <input type="email" name="email" id="email" class="inputForm" placeholder="E-mail (ex: maurouard.laura.10@example.com)" required autocomplete="email" value="<?= $email ?? '' ?>">
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>
            <!-- Password -->
            <label for="password" class="mt-2">Mot de passe <span class="registrationRequired">*</span></label>
            <input type="text" name="password" id="password" class="inputForm" placeholder="Mot de passe (ex: Guigui18!)" required value="<?= $password ?? '' ?>">
            <small <?= ($error['password'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['password'] ?? '' ?></small>
            <!-- Phone number -->
            <label for="phone" class="mt-2">Numéro de téléphone <span class="registrationRequired">*</span></label>
            <input type="text" name="phone" id="phone" class="inputForm" placeholder="Numéro de téléphone (ex: 0612345678)" autocomplete="tel-local" maxlength="10" value="<?= $phone ?? '' ?>" pattern="<?= REGEXP_PHONE_NUMBER ?>">
            <small <?= ($error['phone'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['phone'] ?? '' ?></small>
            <!-- Birthday -->
            <label for="birthdate" class="mt-2">Date de naissance <span class="registrationRequired">*</span></label>
            <input type="date" name="birthdate" id="birthdate" class="inputForm" required autocomplete="bday" value="<?= $birthdate ?? '' ?>" min="<?= date('Y-m-d', time() - (86400 * 365 * 150)) ?>" max="<?= date('Y-m-d') ?>">
            <small <?= ($error['birthdate'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['birthdate'] ?? '' ?></small>

            <!-- Required fields informations -->
            <small class="registrationSmall me-5 mt-3">* Champs obligatoires pour ajouter un client</small>

            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="registrationBtn" id="registrerBtn">Ajouter</button>
            </div>
        </form>
    </div>
</main>
<!-- MAIN end -->