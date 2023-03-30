<?php

// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../models/Appointment.php');

$idAppointment = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

if (!Appointment::isIdExist($idAppointment)) {
    Flash::flash('appointmentDeleted', 'Le rendez-vous que vous essayez de supprimer n\'existe pas', FLASH_WARNING);
    header('Location: /Dashboard/Appointments/List');die;
}else {
    if(Appointment::delete($idAppointment)){
        Flash::flash('appointmentDeleted', 'Le rendez-vous a bien été supprimé', FLASH_SUCCESS);
        header('Location: /Dashboard/Appointments/List');die;
    };
}