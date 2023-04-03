<!-- MAIN -->
<main>
    <!-- Add form -->
    <div class="mt-2 <?= ($addAppointment ?? true) ? '' : 'd-none' ?>">
        <form method="post" class="d-flex flex-column align-items-center" id="appointmentForm">
            <fieldset class="appointmentClientFieldset">
                <h2>Ajout d'un rendez-vous</h2>
            </fieldset>
            <!-- Client -->
            <label for="client" class="mt-2">Client <span class="registrationRequired">*</span></label>
            <select name="idClients" id="client" required>
                <?php
                foreach ($clients as $client) { ?>
                    <option value="<?= $client->id ?>" <?= ($idClients ?? false == $client->id) ? 'selected' : '' ?>><?= $client->lastname . '--' . $client->firstname . '--' . $client->email ?></option>
                <?php } ?>
                <option value="0" <?= ($idClients ?? false) ? '' : 'selected' ?>>--Choisir un client--</option>
            </select>
            <small <?= ($error['idClients'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['idClients'] ?? '' ?></small>

            <!-- Section PRESTA - Liste des prestations à cocher -->
            <form class="d-flex flex-column justify-content-center w-auto" method="post">
                <?php foreach ($prestations as $prestation) { ?>

                    <fieldset class="d-flex justify-content-center">
                        <div class="prestaField d-flex mx-3 my-1 justify-content-between rounded">
                            <div class="labels">
                                <div class="ms-2"><label for="colorPolish"><?= $prestation->title ?></label></div>
                                <div class="d-flex justify-content-between ms-2">
                                    <div class=""><?= $prestation->duration ?>min</div>
                                    <div class="ms-5"><?= $prestation->price ?>€</div>
                                </div>
                            </div>
                            <div class="my-auto me-3">
                                <input type="checkbox" name="prestaCheck[]" class="form-check-input prestaCheck" <?= in_array($prestation->id, $prestaChecked ?? []) ? 'checked' : '' ?> value="<?= $prestation->id ?>" id="presta<?= $prestation->id ?>">
                            </div>
                        </div>
                    </fieldset>
                <?php } ?>
                <small id="smallPresta" class="text-center <?= ($error['presta'] ?? false) ? 'text-danger' : '' ?>"><?= $error['presta'] ?? 'Veuillez sélectionnez 1 prestation minimum et 3 maximum' ?></small>

                <!-- Section PRESTA - END -->


                <!-- RENDEZ-VOUS -->
                <fieldset class="appointmentFieldset">
                    <h2>Rendez-vous</h2>
                </fieldset>
                <!-- Rendez-vous - DAY -->
                <label for="day" class="mt-2">Jour <span class="registrationRequired">*</span></label>
                <input type="date" name="day" id="day" class="inputForm" required value="<?= $day ?? date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" step="1">
                <small <?= ($error['day'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['day'] ?? '' ?></small>

                <!-- Rendez-vous - HOUR -->
                <select class="pe-2" name="hour" id="hour">
                    <option value="">Choisissez une heure</option>
                    <?php
                    foreach ($slots as $slot) {
                        // Transform slotStart & slotEnd to int values
                        $start = intval(substr($slot->slotStart, 0, 2));
                        $end = intval(substr($slot->slotEnd, 0, 2));

                        while ($start < $end) { ?>
                            <option value="<?= ($start < 10) ? '0' . strval($start) : strval($start) ?>"> <?= ($start < 10) ? '0' . $start : $start ?>h</option>
                    <?php
                            $start++;
                        }
                    }
                    ?>
                </select>
                <small <?= ($error['hour'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['hour'] ?? '' ?></small>
                <!-- Rendez-vous - MINUTES -->
                <select name="minutes" id="minutes">
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
                <small <?= ($error['minutes'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['minutes'] ?? '' ?></small>

                <!-- Required fields informations -->
                <small class="registrationSmall mt-3">* Champs obligatoires pour ajouter un rendez-vous</small>

                <!-- Button to registrer -->
                <div class="registrationBtns mt-2">
                    <button class="registrationBtn registrerBtn" id="addAppointmentBtn">Ajouter</button>
                </div>

            </form>
    </div>
</main>
<!-- MAIN end -->