<?php

// CONSTANTES
require_once(__DIR__ . '/../config/constants.php');


if (isset($_COOKIE['lastname'], $_COOKIE['firstname'], $_COOKIE[''])) {
    # code...
}

    // HEADER
    $linkCss = 'home';
    include_once(__DIR__ . '/../views/templates/header.php');

    include_once(__DIR__ . '/../views/home.php');



// FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
