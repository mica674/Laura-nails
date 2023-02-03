    <!-- MAIN -->
    <main>
        <!-- Section 1 - Image d'en-tête -->
        <section class="placeDateSection1Head d-flex ">
            <div class="d-block onlyRdv ms-2"></div>
        </section>
        <!-- Section 1 end -->

        <!-- Section 2 - Informations d'utilisation -->
        <section id="section2">
            <div class="place m-2 py-3 text-center">
                <p class="mb-0">Pour prendre rendez-vous :</p>
                <ol>
                    <li>Sélectionner le(s) prestations souhaitée(s) <br> Attention aux temps des prestations !</li>
                    <li>Choisir une date et une heure voulue pour le rendez-vous</li>
                    <li>Laura vous confirmera la date et l'heure du rendez-vous rapidement</li>
                </ol>
            </div>

        </section>
        <!-- Section 2 end -->

        <!-- Séparation -->
        <div class="hr my-1">
            <hr>
        </div>

        <!-- Section 3 - Liste des prestations à cocher -->

        <form>
            <fieldset>
                <div class="prestaField d-flex m-3 justify-content-between rounded">
                    <div class="labels">
                        <div class="ms-2">Pose vernis couleur</div>
                        <div class="d-flex justify-content-between ms-2">
                            <div class="">15min</div>
                            <div class="ms-5">10€</div>
                        </div>
                    </div>
                    <div class="my-auto me-3">
                        <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="colorPolish">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="prestaField d-flex m-3 justify-content-between rounded">
                    <div class="labels">
                        <div class="ms-2">Pose french soak-off</div>
                        <div class="d-flex justify-content-between ms-2">
                            <div class="">35min</div>
                            <div class="ms-5">29€</div>
                        </div>
                    </div>
                    <div class="my-auto me-3">
                        <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="frenchSoakOff">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="prestaField d-flex m-3 justify-content-between rounded">
                    <div class="labels">
                        <div class="ms-2">Soin des ongles</div>
                        <div class="d-flex justify-content-between ms-2">
                            <div class="">5min</div>
                            <div class="ms-5">4€</div>
                        </div>
                    </div>
                    <div class="my-auto me-3">
                        <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="nailCare">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="prestaField d-flex m-3 justify-content-between rounded">
                    <div class="labels">
                        <div class="ms-2">French peel-off</div>
                        <div class="d-flex justify-content-between ms-2">
                            <div class="">35min</div>
                            <div class="ms-5">29€</div>
                        </div>
                    </div>
                    <div class="my-auto me-3">
                        <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="frenchPeelOff">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="prestaField d-flex m-3 justify-content-between rounded">
                    <div class="labels">
                        <div class="ms-2">Pose vernis french</div>
                        <div class="d-flex justify-content-between ms-2">
                            <div class="">25min</div>
                            <div class="ms-5">13€</div>
                        </div>
                    </div>
                    <div class="my-auto me-3">
                        <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="frenchPolish">
                    </div>
                </div>
            </fieldset>
        </form>


    </main>
    <!-- MAIN end -->