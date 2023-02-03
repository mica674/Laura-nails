<!-- MAIN -->
<main>
    <!-- Login form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="loginForm">
            <fieldset class="loginFieldset">Connexion</fieldset>
            <!-- EMAIL -->
            <label for="email" class="mt-1">email</label>
            <input type="email" name="email" id="email" class="inputForm" placeholder=" email" autocomplete="email" required value="<?=$email??''?>">
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>
            
            <!-- PASSWORD -->
            <label for="password" class="mt-1">Mot de passe</label>
            <input type="password" name="password" id="password" class="inputForm" placeholder=" Mot de passe" autocomplete="password" value="<?=$password??''?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,15}$">
            <small <?= ($error['password'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['password'] ?? 'Le mot de passe doit contenir au minimum : 1 minuscule 1 majuscule 1 caractère spécial et entre 6 et 15 caractères' ?></small>
            
            <!-- Link forgot password -->
            <a href="#" class="forgotPassword text-decoration-none my-3" id="forgotPassword">Mot de passe oublié ?</a>
            
            <!-- Button to log -->
            <input type="submit" class="loginBtn mt-2" id="loginBtn" value="Se connecter">
            
            <!-- Link to go sign up/registration -->
            <a href="/controllers/registrerCtrl.php" class="noRegistered text-decoration-none mt-3" id="noRegistered">Pas encore inscrit ?</a>

        </form>
    </div>
    <!-- Login form end -->

</main>
<!-- MAIN end -->