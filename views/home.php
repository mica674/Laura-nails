        <!-- CAROUSEL -->
        <section>
            <div id="carouselHomePage" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselHomePage" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item carouselItem active">
                        <img src="/public/assets/img/photos/carousel1.jpg" alt="photo vernis à ongle violet">
                    </div>
                    <div class="carousel-item carouselItem">
                        <img src="/public/assets/img/photos/carousel2.jpg" alt="photo bougie tenue en main manucurée">
                    </div>
                    <div class="carousel-item carouselItem">
                        <img src="/public/assets/img/photos/carousel3.jpg" alt="mains manucurées en forme de cercle">
                    </div>
                    <div class="carousel-item carouselItem">
                        <img src="/public/assets/img/photos/carousel4.jpg" alt="mains manucurées en forme de cercle">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHomePage" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselHomePage" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="carouselSubTitle">
                <h2 class="carouselTitle text-center">Photos / Ongles</h2>
            </div>
        </section>
        <!-- CAROUSEL end -->


        <!-- Séparation de section -->
        <div class="hr">
            <hr>
        </div>

        <!-- PLACE & DATE -->
        <section>
            <div class="placeDate text-center" id="place">
                <p class="placeDate-placeText my-5">
                <?= explode(',',LAURA_ADDRESS)[0] . '<br>' . explode(',', LAURA_ADDRESS)[1]?>
                </p>
                <p class="placeDate-dateText mb-5">
                    lundi au vendredi : 9h - 17h
                </p>
            </div>
            <div class="maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1478.5408232480625!2d1.2180906018184967!3d49.879748316059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e0a504daba9153%3A0x8a0025e32becf366!2s122%20Rue%20Edouard%20Cannevel%2C%2076510%20Saint-Nicolas-d&#39;Aliermont!5e1!3m2!1sfr!2sfr!4v1680852260827!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
        <!-- PLACE & DATE end -->


        <!-- Séparation de section -->
        <div class="hr my-3">
            <hr>
        </div>

        <!-- RENDEZ-VOUS -->
        <section>
            <div class="rendezVousTitle text-center my-5">
                <h3>Rendez-vous</h3>
            </div>
            <div class="calendarRendezVous">
                <img src="/public/assets/img/calendar.jpg" alt="Calendrier des rendez-vous">
            </div>
            <div class="buttonRendezVous d-flex justify-content-center my-3">
                <a href="/Rendez_vous" class="text-center buttonPrendreRDV">
                    Prendre rendez-vous
                </a>
            </div>
        </section>
        <!-- RENDEZ-VOUS end -->


        <!-- Séparation de section -->
        <div class="hr my-3">
            <hr>
        </div>

        <!-- REVIEW -->
        <section>
            <!-- Titre de la section -->
            <div class="reviewTitle text-center my-5">
                <h3>Avis</h3>
            </div>
            <!-- Affichage de commentaires déjà postés -->
            <div class="container">
                <div class="reviewCard mb-2">
                    <div class="row reviewRow align-items-center">
                        <div class="reviewNickname ms-3 col-5">
                            <p class="mb-0">Pseudo</p>
                        </div>
                        <div class="reviewDate col-5 offset-1">
                            <p class="mb-0">Date</p>
                        </div>
                    </div>
                    <div class="row reviewRow align-items-center">
                        <div class="reviewComment col-11 ms-3 mb-3">
                            <p class="mb-0">Excellent, je recommande !</p>
                        </div>
                    </div>
                </div>
                <div class="reviewCard mb-2">
                    <div class="row reviewRow align-items-center">
                        <div class="reviewNickname ms-3 col-5">
                            <p class="mb-0">Pseudo</p>
                        </div>
                        <div class="reviewDate col-5 offset-1">
                            <p class="mb-0">Date</p>
                        </div>
                    </div>
                    <div class="row reviewRow align-items-center">
                        <div class="reviewComment col-11 ms-3 mb-3">
                            <p class="mb-0">Excellent, je recommande !</p>
                        </div>
                    </div>
                </div>
                <div class="reviewCard mb-2">
                    <div class="row reviewRow align-items-center">
                        <div class="reviewNickname ms-3 col-5">
                            <p class="mb-0">Pseudo</p>
                        </div>
                        <div class="reviewDate col-5 offset-1">
                            <p class="mb-0">Date</p>
                        </div>
                    </div>
                    <div class="row reviewRow align-items-center">
                        <div class="reviewComment col-11 ms-3 mb-3">
                            <p class="mb-0">Excellent, je recommande !</p>
                        </div>
                    </div>
                </div>
                <div class="reviewCard mb-2">
                    <div class="row reviewRow align-items-center">
                        <div class="reviewNickname ms-3 col-5">
                            <p class="mb-0">Pseudo</p>
                        </div>
                        <div class="reviewDate col-5 offset-1">
                            <p class="mb-0">Date</p>
                        </div>
                    </div>
                    <div class="row reviewRow align-items-center">
                        <div class="reviewComment col-11 ms-3 mb-3">
                            <p class="mb-0">Excellent, je recommande !</p>
                        </div>
                    </div>
                </div>
                <div class="reviewCard mb-2">
                    <div class="row reviewRow align-items-center">
                        <div class="reviewNickname ms-3 col-5">
                            <p class="mb-0">Pseudo</p>
                        </div>
                        <div class="reviewDate col-5 offset-1">
                            <p class="mb-0">Date</p>
                        </div>
                    </div>
                    <div class="row reviewRow align-items-center">
                        <div class="reviewComment col-11 ms-3 mb-3">
                            <p class="mb-0">Excellent, je recommande !</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/Avis" id="reviewBtn" class="text-center">
                    Soumettre un avis
                </a>
            </div>
        </section>
        <!-- REVIEW end -->

        <!-- Séparation de section -->
        <div class="hr my-3">
            <hr>
        </div>


        <!-- CONTACT -->
        <section>
            <div class="d-flex justify-content-center my-4">
                <a href="/Contact" id="contactBtn" class="text-center">
                    Contact
                </a>
            </div>
        </section>
        <!-- CONTACT end -->
        </main>
        <!-- MAIN end -->