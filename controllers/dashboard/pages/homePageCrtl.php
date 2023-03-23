<?php

// CONSTANTES
require_once(__DIR__ . '/../../../config/constants.php');

var_dump($_FILES['carouselImage']??'');

if(isset($_FILES['carouselImage'])){
    $images = $_FILES['carouselImage']['full_path'];
}
// HEADER
$linkCss = 'pages/homePage';
include_once(__DIR__ . '/../../../views/dashboard/templates/header.php');

// VIEW
include_once(__DIR__ . '/../../../views/dashboard/pages/homePage.php');

// FOOTER
$jsToCall = 'homePage';
include_once(__DIR__ . '/../../../views/dashboard/templates/footer.php');
