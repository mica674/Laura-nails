<?php

// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Benefit.php');

$idPresta = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

if (!Benefit::isExist($idPresta)) {
    Flash::flash('prestaDeleted', 'La prestation que vous essayez de récupérer n\'existe pas', FLASH_WARNING);
    header('Location: /Dashboard/Prestations/List');die;
}else {
    if(Benefit::getback($idPresta)){
        Flash::flash('prestaDeleted', 'La prestation a bien été récupérée', FLASH_SUCCESS);
        header('Location: /Dashboard/Prestations/List');die;
    };
}