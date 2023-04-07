<?php

// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

// !HEADER
$linkCss = 'pages/reviews';
include_once(__DIR__ . '/../../../views/dashboard/templates/header.php');

// !VIEW
include_once(__DIR__ . '/../../../views/dashboard/pages/reviews/home.php');

// !FOOTER
include_once(__DIR__ . '/../../../views/dashboard/templates/footer.php');
