<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');


// !HEADER
$linkCss = 'home';
include_once(__DIR__ . '/../views/templates/header.php');


// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/home.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
