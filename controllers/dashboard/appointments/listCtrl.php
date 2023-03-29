<?php
session_start();

// !CONSTANTS
require_once(__DIR__ . '/../../../config/constants.php');

// !FLASH
require_once(__DIR__ . '/../../../helpers/flash.php');


// !MODEL
require_once(__DIR__ . '/../../../models/Appointment.php');
$appointments = Appointment::get();


// !HEADER
$linkCss = 'clients/clients';
include(__DIR__ . '/../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../views/dashboard/appointments/list.php');


// !FOOTER
$jsToCall = 'clientList';
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');