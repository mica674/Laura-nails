<?php

// !CONSTANTS
require_once(__DIR__ . '/../../config/constants.php');

$linkCss = 'dashboard/client';

// !HEADER
include(__DIR__ . '/../../views/dashboard/templates/header.php');


// !VIEW
include(__DIR__ . '/../../views/dashboard/dashboardHome.php');


// !FOOTER
include(__DIR__ . '/../../views/dashboard/templates/footer.php');