<?php
session_start();

// !CONSTANTS
require_once(__DIR__ . '/../../config/constants.php');
// !FLASH
require_once(__DIR__ . '/../../helpers/flash.php');

$linkCss = 'client';
// !HEADER
include(__DIR__ . '/../../views/dashboard/templates/header.php');

FLASH::flash();
// !VIEW
include(__DIR__ . '/../../views/dashboard/dashboardHome.php');


// !FOOTER
include(__DIR__ . '/../../views/dashboard/templates/footer.php');