<?php

// !CONSTANTS
require_once(__DIR__ . '/../../../config/constants.php');


// !MODEL
require_once(__DIR__ . '/../../../models/Client.php');
$clients = Client::get();


// !HEADER
$linkCss = 'clients/clients';
include(__DIR__ . '/../../../views/dashboard/templates/header.php');


// !VIEW
include(__DIR__ . '/../../../views/dashboard/clients/clients.php');


// !FOOTER
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');