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
                <p class="mb-0 ms-2">Nul à chier, à fuir !</p>
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

<div class="mt-2 text-white">
    <form method="post" class="d-flex flex-column align-items-center" id="loginForm">
        <fieldset class="loginFieldset">Donner votre avis</fieldset>
        <!-- PSEUDO -->
        <label for="pseudo" class="mt-1">Votre pseudo</label>
        <input type="text" name="pseudo" id="pseudo" class="inputForm" value="<?= 'pseudo' ?>" readonly>
        <!-- MESSAGE's TITLE -->
        <label for="reviewTitle" class="mt-1">Titre de l'avis</label>
        <input type="text" name="reviewTitle" id="reviewTitle" class="inputForm" placeholder="Titre de l'avis">
        <!-- MESSAGE -->
        <label for="message" class="mt-1">Votre avis</label>
        <textarea name="reviewMessage" id="reviewMessage" cols="30" rows="10" maxlength="500" placeholder="Donnez votre avis ici... (500 caractères maximum)"></textarea>
        <small class="text-center <?= ($error['reviewMessage'] ?? false) ? 'text-danger' : '' ?>"><?= $error['reviewMessage'] ?? 'Message limité à 500 caractères' ?></small>
        <!-- STARS -->
        <div class="d-flex text-decoration-none text-white"">
            <a href="#loginForm" id="star1" class="mx-1"><i class="fa-regular fa-star"></i></a>
            <a href="#loginForm" id="star2" class="mx-1"><i class="fa-regular fa-star"></i></a>
            <a href="#loginForm" id="star3" class="mx-1"><i class="fa-regular fa-star"></i></a>
            <a href="#loginForm" id="star4" class="mx-1"><i class="fa-regular fa-star"></i></a>
            <a href="#loginForm" id="star5" class="mx-1"><i class="fa-regular fa-star"></i></a>
        </div>
        <div class="d-flex justify-content-center">
            <input id="reviewBtn" type="submit" value="Soumettre">
        </div>
    </form>
</div>

</section>
<!-- REVIEW end -->