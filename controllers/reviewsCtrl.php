<?php

// CONSTANTES
require_once(__DIR__ . '/../config/constants.php');




// HEADER
$linkCss = 'reviews';
include_once(__DIR__ . '/../views/templates/header.php');

include_once(__DIR__ . '/../views/reviews.php');


$jsToCall = 'scriptReviews';
// FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
