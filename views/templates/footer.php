    <!-- Séparation de section -->
    <div class="hr my-3">
        <hr>
    </div>

    <!-- FOOTER -->
    <footer class="d-none">
        <!-- ClickableLinks -->
        <div class="clickableLinks d-flex align-items-center justify-content-center">
            <p>BUILDING IN PROGRESS...</p>
        </div>

        <!-- Séparation de section -->
        <div class="hr my-3">
            <hr>
        </div>

        <!-- SocialNetwork -->
        <div class="container-fluid">
            <div class="row mx-2 socialNetwork my-3">
                <div class="col d-flex justify-content-center">
                    <a href="https://www.facebook.com" target="_blank">
                        <img src="/public/assets/img/icones/social network/facebook.png" alt="SocialNetwork Facebook">
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="Facebook.com" target="_blank">
                        <img src="/public/assets/img/icones/social network/instagram.png" alt="SocialNetwork Instagram">
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="Facebook.com" target="_blank">
                        <img src="/public/assets/img/icones/social network/tiktok.png" alt="SocialNetwork Tiktok">
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="Facebook.com" target="_blank">
                        <img src="/public/assets/img/icones/social network/snapchat.png" alt="SocialNetwork Snapchat">
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="Facebook.com" target="_blank">
                        <img src="/public/assets/img/icones/social network/youtube.png" alt="SocialNetwork Youtube">
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="Facebook.com" target="_blank">
                        <img src="/public/assets/img/icones/social network/twitter.png" alt="SocialNetwork Twitter">
                    </a>
                </div>
            </div>
        </div>

    </footer>
    <!-- FOOTER end -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6da33af46d.js" crossorigin="anonymous"></script>
    <?php if ($jsToCall ?? false) { ?>
        <script src="/public/assets/js/<?=$jsToCall?>.js"></script>
    <?php } ?> <!-- Si '$jsToCall' existe et qu'il n'est pas vide, je link le js initialisé dans le controller correspondant à la page en cours -->
    <script src="/public/assets/js/script.js"></script>
    </body>

    </html>