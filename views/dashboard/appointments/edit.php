<!-- MAIN -->
<main>
    <!-- Client profil form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="appointmentEditForm">
            <fieldset class="appointmentClientFieldset">
                <h2>Profil du rendez-vous</h2>
            </fieldset>
            <!-- Client -->
            <label for="client" class="mt-2">Client <span class="registrationRequired">*</span></label>
            <select name="idClients" id="client" required>
                <?php
                foreach ($clients as $client) { ?>
                    <option value="<?= $client->id ?>"><?= $client->lastname . '--' . $client->firstname . '--' . $client->email ?></option>
                <?php } ?>
                <option value="0" selected>--Choisir un client--</option>
            </select>

            <label for="lastname" class="mt-2">Jour</label>
            <input type="text" name="lastname" id="lastname" class="inputForm" placeholder="Nom (ex: Dupond)" required autocomplete="family-name" value="<?=$client->lastname?>" pattern="<?= REGEXP_LASTNAME ?>" readonly>
            <small <?= ($error['lastname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['lastname'] ?? '' ?></small>
            <!-- Firstname -->
            <label for="firstname" class="mt-2">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="inputForm" placeholder="Prénom (ex: Jean)" required autocomplete="given-name" value="<?=$client->firstname?>" pattern="<?= REGEXP_FIRSTNAME ?>" readonly>
            <small <?= ($error['firstname'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['firstname'] ?? '' ?></small>
            <!-- Email -->
            <label for="email" class="mt-2">email</label>
            <input type="email" name="email" id="email" class="inputForm" placeholder="E-mail (ex: dupond.jean@example.com)" required autocomplete="email" value="<?=$client->email?>" readonly>
            <small <?= ($error['email'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['email'] ?? '' ?></small>
            <!-- Phone number -->
            <label for="phone" class="mt-2">Numéro de téléphone</label>
            <input type="tel" name="phone" id="phone" class="inputForm" placeholder="Numéro de téléphone (ex: 0612345678)" autocomplete="tel-local" maxlength="10" value="<?=$client->phone??''?>" pattern="<?=REGEXP_PHONE_NUMBER?>" readonly>
            <!-- Birthday -->
            <label for="birthdate" class="mt-2">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" class="inputForm" required autocomplete="bday" value="<?=$client->birthdate?>" min="<?=date('Y-m-d',time()-(86400*365*150))?>" max="<?=date('Y-m-d')?>" readonly>


            <form method="post" class="d-flex flex-column align-items-center" id="appointmentForm">
            <fieldset class="appointmentFieldset">
                <h2>Ajout d'un rendez-vous</h2>
            </fieldset>
            <!-- Client -->
            <label for="client" class="mt-2">Client <span class="registrationRequired">*</span></label>
            <select name="idClients" id="client" required>
                <?php
                foreach ($clients as $client) { ?>
                    <option value="<?= $client->id ?>"><?= $client->lastname . '--' . $client->firstname . '--' . $client->email ?></option>
                <?php } ?>
                <option value="0" selected>--Choisir un client--</option>
            </select>
            <small <?= ($error['idClients'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['idClients'] ?? '' ?></small>
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




            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="modifyBtn d-none" id="clientEditBtn">Enregistrer</button>
            </div>


        </form>
    </div>
</main>
<!-- MAIN end -->