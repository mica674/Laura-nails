<!-- MAIN -->
<main>
    <!-- Add form -->
    <div class="mt-2 <?= ($addAppointment??true)?'':'d-none'?>">
        <form method="post" class="d-flex flex-column align-items-center" id="appointmentForm">
            <fieldset class="appointmentFieldset"><h2>Ajout d'un créneau rendez-vous</h2></fieldset>
            <!-- SLOTS -->
            <fieldset>Créneau</fieldset>
            <!-- Début -->
            <label for="slotStart" class="mt-2">Début <span class="registrationRequired">*</span></label>
            <input type="time" name="slotStart" id="slotStart" class="inputForm" required value="<?=$slotStart??''?>">
            <small <?= ($error['slotStart'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['slot'] ?? '' ?></small>
            <!-- Fin -->
            <label for="slotEnd" class="mt-2">Fin <span class="registrationRequired">*</span></label>
            <input type="time" name="slotEnd" id="slotEnd" class="inputForm" required value="<?=$slotEnd??''?>">
            <small <?= ($error['slotEnd'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['slot'] ?? '' ?></small>
            <!-- Intervalle en minutes -->
            <label for="slotStep" class="mt-2">Intervalle (en minutes) <span class="registrationRequired">*</span></label>
            <input type="number" name="slotStep" id="slotStep" class="inputForm" required value="<?=$slotStep??''?>">

            <!-- Required fields informations -->
            <small class="registrationSmall mt-3">* Champs obligatoires pour ajouter un créneau de rendez-vous</small>

            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="registrationBtn registrerBtn" id="addAppointmentBtn">Ajouter</button>
            </div>

        </form>
    </div>
</main>
<!-- MAIN end -->
