<!-- MAIN -->
<main>
    <!-- Slot profil form -->
    <div class="mt-2">
        <form method="post" class="d-flex flex-column align-items-center" id="slotEditForm">
            <fieldset class="slotFieldset"><h2>Profil du créneau</h2></fieldset>
            <!-- Slot Start -->
            <label for="slotStart" class="mt-2">Début</label>
            <input type="time" name="slotStart" id="slotStart" class="inputForm" placeholder="Début (ex: 9h00)" required value="<?=$slot->slotStart?>" pattern="<?= REGEXP_SLOT ?>" readonly>
            <small <?= ($error['slotStart'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['slotStart'] ?? '' ?></small>
            <!-- Slot End -->
            <label for="slotEnd" class="mt-2">Fin</label>
            <input type="time" name="slotEnd" id="slotEnd" class="inputForm" placeholder="Fin (ex: 17h00)" required value="<?=$slot->slotEnd?>" pattern="<?= REGEXP_SLOT ?>" readonly>
            <small <?= ($error['slotEnd'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['slotEnd'] ?? '' ?></small>
            <!-- Slot Step -->
            <label for="slotStep" class="mt-2">Intervalle</label>
            <select name="slotStep" id="slotStep" class="inputForm" required>
                <option value="5" <?=($slot->slotStep == 5)?'selected':''?>>5</option>
                <option value="10" <?=($slot->slotStep == 10)?'selected':''?>>10</option>
                <option value="15" <?=($slot->slotStep == 15)?'selected':''?>>15</option>
                <option value="20" <?=($slot->slotStep == 20)?'selected':''?>>20</option>
                <option value="30" <?=($slot->slotStep == 30)?'selected':''?>>30</option>
            </select>
            <small <?= ($error['slotStep'] ?? false) ? 'class="text-danger"' : '' ?>><?= $error['slotStep'] ?? '' ?></small>
            
            <!-- Button to registrer -->
            <div class="registrationBtns mt-2">
                <button class="modifyBtn d-none" id="slotEditBtn">Enregistrer</button>
            </div>


        </form>
    </div>
</main>
<!-- MAIN end -->