<?php

// CONSTANTES
require_once(__DIR__ . '/../../../config/constants.php');

// HEADER
$linkCss = 'pages/homePage';
include_once(__DIR__ . '/../../../views/dashboard/templates/header.php');

// VIEW
include_once(__DIR__ . '/../../../views/dashboard/pages/homePage.php');

// FOOTER
$jsToCall = 'homePage';
include_once(__DIR__ . '/../../../views/dashboard/templates/footer.php');
