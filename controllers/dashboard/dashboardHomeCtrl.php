<?php
// !INIT
require_once(__DIR__ . '/../../config/initDashboard.php');


// !HEADER
$linkCss = 'home';
include(__DIR__ . '/../../views/dashboard/templates/header.php');

FLASH::flash();
// !VIEW
include(__DIR__ . '/../../views/dashboard/dashboardHome.php');


// !FOOTER
include(__DIR__ . '/../../views/dashboard/templates/footer.php');
