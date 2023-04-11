 <!-- Client profil form -->
 <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="profilForm">
            <fieldset class="profilFieldset">
                <h2>Votre profil</h2>
            </fieldset>
            <!-- Lastname -->
            <label for="lastname" class="mt-2">Nom</label>
            <input type="text" name="lastname" id="lastname" class="inputForm inputJS rounded" placeholder="Nom (ex: Dupond)" required autocomplete="family-name" value="<?= $client->lastname ?>" pattern="<?= REGEXP_LASTNAME ?>" readonly>
            <small <?= ($error['lastname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['lastname'] ?? '' ?></small>
            <!-- Firstname -->
            <label for="firstname" class="mt-2">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="inputForm inputJS rounded" placeholder="Prénom (ex: Jean)" required autocomplete="given-name" value="<?= $client->firstname ?>" pattern="<?= REGEXP_FIRSTNAME ?>" readonly>
            <small <?= ($error['firstname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['firstname'] ?? '' ?></small>
            <!-- Email -->
            <label for="email" class="mt-2">email</label>
            <input type="email" name="email" id="email" class="inputForm inputJS rounded" placeholder="E-mail (ex: dupond.jean@example.com)" required autocomplete="email" value="<?= $client->email ?>" readonly>
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>
            <!-- Phone number -->
            <label for="phone" class="mt-2">Numéro de téléphone</label>
            <input type="tel" name="phone" id="phone" class="inputForm inputJS rounded" placeholder="Numéro de téléphone (ex: 0612345678)" autocomplete="tel-local" maxlength="10" value="<?= $client->phone ?? '' ?>" pattern="<?= REGEXP_PHONE_NUMBER ?>" readonly>
            <!-- Birthday -->
            <label for="birthdate" class="mt-2">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" class="inputForm inputJS rounded" required autocomplete="bday" value="<?= $client->birthdate ?>" min="<?= date('Y-m-d', time() - (86400 * 365 * 150)) ?>" max="<?= date('Y-m-d') ?>" readonly>

            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="modifyBtn d-none" id="profilBtn">Enregistrer</button>
            </div>

        </form>
    </div>