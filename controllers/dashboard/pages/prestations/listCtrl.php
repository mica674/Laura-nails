<?php
// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODEL
require_once(__DIR__ . '/../../../../models/Benefit.php');
$prestations = Benefit::get();


// !HEADER
$linkCss = 'pages/prestations';
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../../views/dashboard/pages/prestations/list.php');


// !FOOTER
$jsToCall = 'prestationList';
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');