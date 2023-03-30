<?php

// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');


// !MODEL
require_once(__DIR__ . '/../../../../models/Slot.php');
$slots = Slot::get();


// !HEADER
$linkCss = 'pages/prestations';
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../../views/dashboard/appointments/slots/list.php');


// !FOOTER
$jsToCall = 'slotsList';
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');