<?php

// CONSTANTES
require_once(__DIR__ . '/../config/constants.php');

var_dump($_POST['prestaCheck']??'');


    // HEADER
    $linkCss = 'rendezVous';
    include_once(__DIR__ . '/../views/templates/header.php');

    include_once(__DIR__ . '/../views/rendezVous.php');



// FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
