<?php
// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');


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
$jsToCall = 'appointmentsList';
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');