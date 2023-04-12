
<!-- FORM -->
<div class="mt-5 text-white">
    <form method="post" class="<?= !$clientConnected?'d-none':''?> d-flex flex-column align-items-center" id="reviewForm">
        <fieldset class="loginFieldset"><h2>Donner votre avis</h2></fieldset>
        <!-- FIRSTNAME -->
        <label for="firstname" class="mt-1">Votre prénom</label>
        <input type="text" name="firstname" id="firstname" class="inputForm rounded" value="<?= ($methodToConnect == 'session')?$_SESSION['client']->firstname:unserialize($_COOKIE['client'])->firstname ?>" readonly>
        <!-- MESSAGE's TITLE -->
        <label for="title" class="mt-1">Titre de l'avis</label>
        <input type="text" name="title" id="title" class="inputForm rounded" placeholder="Titre de l'avis" value="<?= $title ?? '' ?>">
        <small class="text-center <?= ($error['title'] ?? false) ? 'text-danger' : '' ?>"><?= $error['title'] ?? '' ?></small>
        <!-- MESSAGE -->
        <label for="message" class="mt-1">Votre avis</label>
        <textarea name="message" class="rounded" id="message" cols="30" rows="10" maxlength="500" placeholder="Donnez votre avis ici... (500 caractères maximum)"><?= $message ?? '' ?></textarea>
        <small class="text-center <?= ($error['message'] ?? false) ? 'text-danger' : '' ?>"><?= $error['message'] ?? 'Message limité à 500 caractères' ?></small>
        <!-- STARS -->
        <div class="d-flex text-decoration-none text-white my-2">
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


<div class="container mt-5">

<h2>Les derniers avis postés</h2>
    <?php
    foreach ($last5Comments as $comment) { if (!is_null($comment->moderated_at)) {
    ?>

        <div class="reviewCard mb-2 rounded">
            <div class="row reviewRow align-items-center">
                <div class="reviewNickname ms-3 col-5">
                    <p class="mb-0 ms-2"><?= Client::get($comment->id_clients)->firstname ?></p>
                </div>
                <div class="reviewDate col-5 offset-1">
                    <p class="mb-0 ms-2"><?=$comment->title?><small class="d-none d-md-inline ms-5"><?= datefmt_format(DATE_FORMAT_HOUR, strtotime($comment->created_at)) ?></small></p>
                </div>
            </div>
            <div class="row reviewRow align-items-center">
                <div class="reviewComment col-11 ms-3 mb-2">
                    <p class="mb-0 ms-2"><?= $comment->content ?>
                        <small>
                            <?php
                            $stars = $comment->quotations; //Nombre d'étoiles de l'avis
                            $star = 1; //Initialisation première étoile
                            while ($star <= $stars) { ?>
                            <!-- Etoile pleine -->
                            <i class="fa-solid fa-star"></i> 
                            <?php $star++;
                            }
                            while ($star <= 5) { ?>
                                <!-- Etoile vide -->
                                <i class="fa-regular fa-star"></i>
                            <?php $star++;
                            }
                            ?></small>
                    </p>
                </div>
            </div>
        </div>

    <?php
    }}
    ?>
</div>

<!-- REVIEW end -->