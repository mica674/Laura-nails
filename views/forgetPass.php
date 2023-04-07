<!-- MAIN -->
<main>
    
    <!-- Forget Password form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="forgetPassForm">
            <fieldset class="forgetPassFieldset">Mot de passe oublié</fieldset>
            <!-- EMAIL -->
            <label for="email" class="mt-1">email</label>
            <input type="email" name="email" id="email" class="inputForm" placeholder=" Votre email" autocomplete="email" required value="<?= $email ?? '' ?>">
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>

            <small class="text-center <?= ($error['global'] ?? false) ? 'text-danger' : '' ?>"><?= $error['global'] ?? '' ?></small>

            <!-- Button to log -->
            <input type="submit" class="forgetPassBtn mt-2" id="forgetPassBtn" value="Réinitialiser mon mot de passe">

            <!-- Link to go sign up/registration -->
            <a href="/Connexion" class="forgetPass text-decoration-none mt-3" id="forgetPass">Se connecter</a>

        </form>
    </div>
    <!-- forgetPass form end -->

</main>
<!-- MAIN end -->