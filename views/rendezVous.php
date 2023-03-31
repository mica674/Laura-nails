<!-- MAIN -->
<main>
    <!-- Section 1 - Image d'en-tête -->
    <section class="placeDateSection1Head d-flex ">
        <div class="d-block onlyRdv ms-2"></div>
    </section>
    <!-- Section 1 end -->

    <div class="container-fluid">
        <div class="row flex-column">
            <div class="col-12 col-lg-5 mx-auto">
                <!-- Section 2 - Informations d'utilisation -->
                <section id="section2">
                    <div class="place m-2 py-3 text-center rounded">
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
            <div class="col-12 col-lg-5 p-0 mx-auto">
                <!-- Section 3 - Liste des prestations à cocher -->
                <form class="d-flex flex-column justify-content-center w-auto" method="post">
                    <?php foreach ($prestations as $prestation) {?>

                        <fieldset class="d-flex justify-content-center">
                            <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                                <div class="labels">
                                    <div class="ms-2"><label for="colorPolish"><?=$prestation->title?></label></div>
                                    <div class="d-flex justify-content-between ms-2">
                                        <div class=""><?=$prestation->duration?>min</div>
                                        <div class="ms-5"><?=$prestation->price?>€</div>
                                    </div>
                                </div>
                                <div class="my-auto me-3">
                                    <input type="checkbox" name="prestaCheck[]" class="form-check-input" value="<?=$prestation->id?>" id="presta<?=$prestation->id?>">
                                </div>
                            </div>
                        </fieldset>
                        <?php }?>

                    <!-- Section 3 - END -->
                    <!-- Section 4 - Choix de la date et heure du rdv -->

                        <div class="row">
                            <div class="col-12 d-flex justify-content-center mt-3 ">
                                <!-- Jour/mois/année -->
                                <input type="date" name="appointment" id="appointment" class="inputForm rounded" required value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-12 d-flex flex-column w-50 mx-auto my-3">
                                <!-- 2 select (Heure et minutes(step 5min)) -->
                                <select class="pe-2 my-2 rounded" name="hour" id="hour">
                                    <option value="">Choisissez une heure</option>
                                    <?php
                                    foreach ($slots as $slot) {
                                        // Transform slotStart & slotEnd to int values
                                        $start = intval(substr($slot->slotStart, 0, 2));
                                        $end = intval(substr($slot->slotEnd, 0, 2));

                                        while ($start < $end) { ?>
                                            <option value="<?= strval($start) ?>"> <?= $start ?>h</option>
                                    <?php
                                            $start++;
                                        }
                                    }
                                    ?>
                                </select>
                                <select class="my-2 rounded" name="minutes" id="minutes">
                                    <option value="">Choisissez un créneau</option>
                                    <?php
                                    $min = 0;
                                    $step = $slots[0]->slotStep;
                                    while ($min < 60) { ?>
                                        <option value="<?= ($min == 0) ? '00' : (($min == 5) ? '05' : strval($min)) ?>"><?= ($min == 0) ? '00' : (($min == 5) ? '05' : strval($min)) ?></option>
                                    <?php
                                        $min += $step;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    <input type="submit" value="Demander un rendez-vous" class="btnRdvSubmit mx-auto rounded" id="btnRdvSubmit">
                </form>
            </div>
        </div>
    </div>



</main>
<!-- MAIN end -->