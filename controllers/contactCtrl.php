<?php

// !CONSTANTS
require_once(__DIR__ . '/../config/constants.php');
// !FLASH
require_once(__DIR__ . '/../helpers/flash.php');


// !HEADER
$linkCss = 'contact';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/contact.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
