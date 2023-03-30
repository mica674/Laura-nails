<?php

// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Slot.php');

$idSlot = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

if (!Slot::isExist('id', $idSlot)) {
    Flash::flash('slotDeleted', 'Le créneau que vous essayez de supprimer n\'existe pas', FLASH_WARNING);
    header('Location: /Dashboard/Appointments/Slots/List');die;
}else {
    if(Slot::delete($idSlot)){
        Flash::flash('slotDeleted', 'Le créneau a bien été supprimé', FLASH_SUCCESS);
        header('Location: /Dashboard/Appointments/Slots/List');die;
    };
}