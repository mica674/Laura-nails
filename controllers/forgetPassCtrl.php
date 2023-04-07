<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');


// !MODELS
require_once(__DIR__ . '/../models/Client.php');






// !HEADER
$linkCss = 'forgetPass';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/forgetPass.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
