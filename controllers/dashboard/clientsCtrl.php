<?php

// !CONSTANTS
require_once(__DIR__ . '/../config/constants.php');


// !MODEL
require_once(__DIR__ . '/../models/Client.php');
$clients = Client::getAll();


// !HEADER
$linkCss = 'dashboard/client';
include(__DIR__ . '/../views/templates/header.php');


// !VIEW
include(__DIR__ . '/../../views/dashboard/clients/clients.php');


// !FOOTER
include(__DIR__ . '/../views/templates/footer.php');