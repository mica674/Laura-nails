<?php

// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !HEADER
$linkCss = 'pages/prestations';
include_once(__DIR__ . '/../../../../views/dashboard/templates/header.php');

// !VIEW
include_once(__DIR__ . '/../../../../views/dashboard/appointments/slots/slotsHome.php');

// !FOOTER
$jsToCall = 'prestations';
include_once(__DIR__ . '/../../../../views/dashboard/templates/footer.php');
