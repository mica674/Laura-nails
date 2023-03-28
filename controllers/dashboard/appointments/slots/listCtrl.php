<?php
session_start();

// !CONSTANTS
require_once(__DIR__ . '/../../../../config/constants.php');

// !FLASH
require_once(__DIR__ . '/../../../../helpers/flash.php');


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