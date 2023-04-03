<?php

// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../models/Appointment.php');

$idAppointment = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

if (!Appointment::isIdExist($idAppointment)) {
    Flash::flash('appointmentValidated', 'Le rendez-vous que vous essayez de valider n\'existe pas', FLASH_WARNING);
    header('Location: /Dashboard/Appointments/List');die;
}else {
    if(Appointment::validate($idAppointment)){
        Flash::flash('appointmentDeleted', 'Le rendez-vous a bien été validé', FLASH_SUCCESS);
        header('Location: /Dashboard/Appointments/List');die;
    };
}