<!-- MAIN -->
<main>
    <!-- Section 1 - Image d'en-tête -->
    <section class="placeDateSection1Head d-flex ">
        <div class="d-block onlyRdv ms-2"></div>
    </section>
    <!-- Section 1 end -->

    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-12 col-lg-5">
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
                <div class="hr my-1 d-lg-none">
                    <hr>
                </div>
            </div>
            <div class="col-12 col-lg-5 p-0">
                <!-- Section 3 - Liste des prestations à cocher -->
                <form class="d-flex flex-column justify-content-center" method="post">
                    <fieldset class="d-flex justify-content-center">
                        <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                            <div class="labels">
                                <div class="ms-2"><label for="colorPolish">Pose vernis couleur</label></div>
                                <div class="d-flex justify-content-between ms-2">
                                    <div class="">15min</div>
                                    <div class="ms-5">10€</div>
                                </div>
                            </div>
                            <div class="my-auto me-3">
                                <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="colorPolish" id="colorPolish">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="d-flex justify-content-center">
                        <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                            <div class="labels">
                                <div class="ms-2"><label for="colorPolish">Pose french soak-off</label></div>
                                <div class="d-flex justify-content-between ms-2">
                                    <div class="">35min</div>
                                    <div class="ms-5">29€</div>
                                </div>
                            </div>
                            <div class="my-auto me-3">
                                <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="frenchSoakOff" id="frenchSoakOff">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="d-flex justify-content-center">
                        <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                            <div class="labels">
                                <div class="ms-2"><label for="colorPolish">Soin des ongles</label></div>
                                <div class="d-flex justify-content-between ms-2">
                                    <div class="">5min</div>
                                    <div class="ms-5">4€</div>
                                </div>
                            </div>
                            <div class="my-auto me-3">
                                <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="nailCare" id="nailCare">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="d-flex justify-content-center">
                        <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                            <div class="labels">
                                <div class="ms-2"><label for="colorPolish">French peel-off</label></div>
                                <div class="d-flex justify-content-between ms-2">
                                    <div class="">35min</div>
                                    <div class="ms-5">29€</div>
                                </div>
                            </div>
                            <div class="my-auto me-3">
                                <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="frenchPeelOff" id="frenchPeelOff">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="d-flex justify-content-center">
                        <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                            <div class="labels">
                                <div class="ms-2"><label for="colorPolish">Pose vernis french</label></div>
                                <div class="d-flex justify-content-between ms-2">
                                    <div class="">25min</div>
                                    <div class="ms-5">13€</div>
                                </div>
                            </div>
                            <div class="my-auto me-3">
                                <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="frenchPolish" id="frenchPolish">
                            </div>
                        </div>
                    </fieldset>

                    <!-- Section 3 - END -->
                    <!-- Section 4 - Choix de la date et heure du rdv -->

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center mt-3 ">
                                <!-- Jour/mois/année -->
                                <input type="date" name="appointment" id="appointment" class="inputForm" required value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-12 d-flex justify-content-evenly my-3">
                                <!-- 2 select (Heure et minutes(step 5min)) -->
                                <select class="pe-2" name="hour" id="hour">
                                    <option value="">Choisissez une heure</option>
                                    <?php
                                    $hour = 9;
                                    $endHour = 18;
                                    while ($hour < $endHour) { ?>
                                        <option value="<?= strval($hour) ?>"> <?= $hour ?>h</option>
                                        <?php
                                            $hour++;
                                    }
                                    ?>
                                </select>
                                <select name="minutes" id="minutes">
                                <option value="">Choisissez un créneau</option>
                                <?php
                                    $min = 0;
                                    $stepMin = 5;
                                    while ($min < 60) { ?>
                                        <option value="<?= ($min == 0) ? '00' : (($min == 5)? '05' :strval($min)) ?>"><?= ($min == 0) ? '00' : (($min == 5)? '05' :strval($min)) ?></option>
                                        <?php
                                        $min += $stepMin;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Demande un rendez-vous" class="btnRdvSubmit">
                </form>
            </div>
        </div>
    </div>



</main>
<!-- MAIN end -->