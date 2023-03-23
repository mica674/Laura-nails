<?php

// !CONSTANTES
require_once(__DIR__ . '/../config/constants.php');
// !FLASH
require_once(__DIR__ . '/../helpers/flash.php');


// if (isset($_COOKIE['lastname'], $_COOKIE['firstname'], $_COOKIE[''])) {
//     # code...
// }

// !HEADER
$linkCss = 'home';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/home.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
