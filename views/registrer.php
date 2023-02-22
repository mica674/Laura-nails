<!-- MAIN -->
<main>
    <!-- Registration form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="registrationForm">
            <fieldset class="loginFieldset">Inscription</fieldset>
            <!-- Lastname -->
            <label for="lastname" class="mt-1">Nom <span class="registrationRequired">*</span></label>
            <input type="text" name="lastname" id="lastname" class="inputForm" placeholder="Nom" required autocomplete="family-name" value="<?=$lastname??''?>" pattern="<?= REGEXP_LASTNAME ?>">
            <small <?= ($error['lastname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['lastname'] ?? '' ?></small>
            <!-- Firstname -->
            <label for="firstname" class="mt-1">Prénom <span class="registrationRequired">*</span></label>
            <input type="text" name="firstname" id="firstname" class="inputForm" placeholder="Prénom" required autocomplete="given-name" value="<?=$firstname??''?>" pattern="<?= REGEXP_FIRSTNAME ?>">
            <small <?= ($error['firstname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['firstname'] ?? '' ?></small>
            <!-- Email -->
            <label for="email" class="mt-1">email <span class="registrationRequired">*</span></label>
            <input type="email" name="email" id="email" class="inputForm" placeholder="E-mail" required autocomplete="email" value="<?= $email ?? '' ?>">
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>
            <!-- Password -->
            <label for="password" class="mt-1 password" maxlegnth="1">Mot de passe <span class="registrationRequired">*</span></label>
            <input type="password" name="password" id="password" class="inputForm inputPassword" placeholder="Mot de passe" required autocomplete="password" value="<?= $password ?? '' ?>" pattern="<?=REGEXP_PASSWORD?>">
            <!-- Confirmed password -->
            <label for="confirmPassword" class="mt-1">Confirmer mot de passe <span class="registrationRequired">*</span></label>
            <input type="password" name="confirmedPassword" id="confirmedPassword" class="inputForm inputPassword" placeholder="Confirmation du mot de passe" required autocomplete="password" value="<?= $confirmedPassword ?? '' ?>" pattern="<?=REGEXP_PASSWORD?>">
            <!-- Phone number -->
            <label for="phoneNumber" class="mt-1">Numéro de téléphone <span class="registrationRequired">*</span></label>
            <input type="text" name="phoneNumber" id="phoneNumber" class="inputForm" placeholder="Numéro de téléphone" required autocomplete="tel-local" maxlength="10" value="<?=$phoneNumber??''?>" pattern="<?=REGEXP_PHONE_NUMBER?>">
            <!-- Birthday -->
            <label for="Birthday" class="mt-1">Date de naissance</label>
            <input type="date" name="birthday" id="birthday" class="inputForm" placeholder="Date de naissance" autocomplete="bday" value="<?= $birthday ?? '' ?>" min="1900-01-01" max="2010-01-01">
            
            <!-- Required fields informations -->
            <small class="registrationSmall me-5">* Champs obligatoires pour s'inscrire</small>

            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="registrationBtn" id="registrerBtn">S'inscrire</button>
            </div>

            <!-- Already Registered -->
            <a href="/controllers/loginCtrl.php" class="alreadyRegistered text-decoration-none mt-2" id="alreadyRegistered">Déjà inscrit ?</a>
        </form>
    </div>
</main>
<!-- MAIN end -->   
