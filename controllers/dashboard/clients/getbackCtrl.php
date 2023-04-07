<?php

// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../models/Client.php');

$idClient = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

if (!Client::isIdExist($idClient)) {
    Flash::flash('clientDeleted', 'Le client que vous essayez de récupérer n\'existe pas', FLASH_WARNING);
    header('Location: /Dashboard/Clients/List');die;
}else {
    if(Client::getback($idClient)){
        Flash::flash('clientDeleted', 'Le client a bien été récupéré', FLASH_SUCCESS);
        header('Location: /Dashboard/Clients/List');die;
    };
}