    <!-- MAIN -->
    <main>
        <!-- Section 1 - Horaires -->
        <section class="placeDateSection1Head d-flex ">
            <div class="openingHours">
                <div class="d-flex justify-content-center mt-4">
                    <ul class="list-group list-group-flush d-flex align-items-end">
                        <li class=""> Lundi : 9h - 17h</li>
                        <li class=""> Mardi : 9h - 17h</li>
                        <li class=""> Mercredi : 9h - 17h</li>
                        <li class=""> Jeudi : 9h - 17h</li>
                        <li class=""> Vendredi : 9h - 17h</li>
                    </ul>
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <p class="p-0 my-auto me-1">Uniquement sur rendez-vous :</p>
                    <a href="/Rendez_vous" title="Prendre rendez-vous"><i class="fa-regular fa-calendar-check"></i></a>
                </div>
            </div>
        </section>
        <!-- Section 1 end -->

        <!-- Section 2 - Adresse -->
        <section id="section2">
            <div class="place m-2 py-3 text-center">
                <p class="mb-0"> <?= explode(',', LAURA_ADDRESS)[0] ?></p>
                <p class="mb-0"><?=explode(',', LAURA_ADDRESS)[1]?></p>
            </div>

        </section>
        <!-- Section 2 end -->

        <!-- Séparation -->
        <div class="hr my-1">
            <hr>
        </div>

        <!-- Section 3 - Carte google Maps -->
        <section id="section3">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1478.5408232480625!2d1.2180906018184967!3d49.879748316059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e0a504daba9153%3A0x8a0025e32becf366!2s122%20Rue%20Edouard%20Cannevel%2C%2076510%20Saint-Nicolas-d&#39;Aliermont!5e1!3m2!1sfr!2sfr!4v1680852260827!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

        <!-- Séparation -->
        <div class="hr my-1">
            <hr>
        </div>
        <!-- Section 3 end -->


        <!-- Section 4 - Plan métro parisien -->
        <section id="section4">
            <div class="metroMap">
                <a href="/public/assets/img/Plan-Metro-Paris.png"
                title="Agrandir le plan"
                    target="_blank">
                    <img class=""
                        src="/public/assets/img/Plan-Metro-Paris.png"
                        alt="Plan général metro, agrandir le plan">
                </a>
            </div>
        </section>
    </main>
    <!-- MAIN end -->
