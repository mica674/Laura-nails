<div class="container">
    <div class="reviewCard mb-2">
        <div class="row reviewRow align-items-center">
            <div class="reviewNickname ms-3 col-5">
                <p class="mb-0 ms-2">Cyboc</p>
            </div>
            <div class="reviewDate col-5 offset-1">
                <p class="mb-0 ms-2">12 mai 2022</p>
            </div>
        </div>
        <div class="row reviewRow align-items-center">
            <div class="reviewComment col-11 ms-3 mb-3">
                <p class="mb-0 ms-2">Excellent, je recommande !</p>
            </div>
        </div>
    </div>
    <div class="reviewCard mb-2">
        <div class="row reviewRow align-items-center">
            <div class="reviewNickname ms-3 col-5">
                <p class="mb-0 ms-2">ikryzz</p>
            </div>
            <div class="reviewDate col-5 offset-1">
                <p class="mb-0 ms-2">27/02/2023</p>
            </div>
        </div>
        <div class="row reviewRow align-items-center">
            <div class="reviewComment col-11 ms-3 mb-3">
                <p class="mb-0 ms-2">Pas mal sympa la meuf !</p>
            </div>
        </div>
    </div>
    <div class="reviewCard mb-2">
        <div class="row reviewRow align-items-center">
            <div class="reviewNickname ms-3 col-5">
                <p class="mb-0 ms-2">Maxou</p>
            </div>
            <div class="reviewDate col-5 offset-1">
                <p class="mb-0 ms-2">31/12/2022</p>
            </div>
        </div>
        <div class="row reviewRow align-items-center">
            <div class="reviewComment col-11 ms-3 mb-3">
                <p class="mb-0 ms-2">Nul à chier, à fuire !</p>
            </div>
        </div>
    </div>
    <div class="reviewCard mb-2">
        <div class="row reviewRow align-items-center">
            <div class="reviewNickname ms-3 col-5">
                <p class="mb-0 ms-2">Pseudo</p>
            </div>
            <div class="reviewDate col-5 offset-1">
                <p class="mb-0 ms-2">Date</p>
            </div>
        </div>
        <div class="row reviewRow align-items-center">
            <div class="reviewComment col-11 ms-3 mb-3">
                <p class="mb-0 ms-2">Excellent, je recommande !</p>
            </div>
        </div>
    </div>
    <div class="reviewCard mb-2">
        <div class="row reviewRow align-items-center">
            <div class="reviewNickname ms-3 col-5">
                <p class="mb-0 ms-2">Pseudo</p>
            </div>
            <div class="reviewDate col-5 offset-1">
                <p class="mb-0 ms-2">Date</p>
            </div>
        </div>
        <div class="row reviewRow align-items-center">
            <div class="reviewComment col-11 ms-3 mb-3">
                <p class="mb-0 ms-2">Excellent, je recommande !</p>
            </div>
        </div>
    </div>
</div>

<!-- FORM -->
<div class="mt-2 text-white">
    <form method="post" class="d-flex flex-column align-items-center" id="reviewForm">
        <fieldset class="loginFieldset">Donner votre avis</fieldset>
        <!-- FIRSTNAME -->
        <label for="firstname" class="mt-1">Votre prénom</label>
        <input type="text" name="firstname" id="firstname" class="inputForm" value="<?= 'Jean-Michmich' ?>" readonly>
        <!-- MESSAGE's TITLE -->
        <label for="title" class="mt-1">Titre de l'avis</label>
        <input type="text" name="title" id="title" class="inputForm" placeholder="Titre de l'avis" value="<?= $title ?? '' ?>">
        <small class="text-center <?= ($error['title'] ?? false) ? 'text-danger' : '' ?>"><?= $error['title'] ?? '' ?></small>
        <!-- MESSAGE -->
        <label for="message" class="mt-1">Votre avis</label>
        <textarea name="message" id="message" cols="30" rows="10" maxlength="500" placeholder="Donnez votre avis ici... (500 caractères maximum)"><?= $message ?? '' ?></textarea>
        <small class="text-center <?= ($error['message'] ?? false) ? 'text-danger' : '' ?>"><?= $error['message'] ?? 'Message limité à 500 caractères' ?></small>
        <!-- STARS -->
        <div class="d-flex text-decoration-none text-white"">
            <button type="button" id="star1" class=""><i class="fa-regular fa-star"></i></button>
            <button type="button" id="star2" class=""><i class="fa-regular fa-star"></i></button>
            <button type="button" id="star3" class=""><i class="fa-regular fa-star"></i></button>
            <button type="button" id="star4" class=""><i class="fa-regular fa-star"></i></button>
            <button type="button" id="star5" class=""><i class="fa-regular fa-star"></i></button>
        </div>
        <!-- VALUE STARS HIDDEN -->
        <input type="number" name="star" id="starVal" hidden>
        <small class="text-danger" id="errorMessageStars"></small>
        <!-- SUBMIT -->
        <div class="d-flex justify-content-center">
            <input id="reviewBtn" type="submit" value="Soumettre">
        </div>
    </form>
</div>

</section>
<!-- REVIEW end -->