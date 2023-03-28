<!-- MAIN -->
<main>
    <!-- Add form -->
    <div class="mt-2 <?= ($addAppointment??true)?'':'d-none'?>">
        <form method="post" class="d-flex flex-column align-items-center" id="appointmentForm">
            <fieldset class="loginFieldset"><h2>Ajout d'un rendez-vous</h2></fieldset>
            <!-- Client -->
            <label for="client" class="mt-2">Client <span class="registrationRequired">*</span></label>
            <select name="idClients" id="client" required>
                <?php
                foreach ($clients as $client) {?>
                    <option value="<?=$client->id?>"><?=$client->lastname . '--' . $client->firstname . '--' . $client->email?></option>
                    <?php }?>
                    <option value="0" selected>--Choisir un client--</option>
            </select>
            <small <?= ($error['client'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['client'] ?? '' ?></small>
            <!-- Rendez-vous -->
            <label for="appointment" class="mt-2">Rendez-vous <span class="registrationRequired">*</span></label>
            <input type="datetime-local" name="appointment" id="appointment" class="inputForm" required value="<?=date('Y-m-d\TH:i')?>" min="<?=date('Y-m-d\TH:00')?>" step="900">
            <small <?= ($error['appointment'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['appointment'] ?? '' ?></small>

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
