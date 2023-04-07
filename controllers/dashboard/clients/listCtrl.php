<?php
// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');


// !MODEL
require_once(__DIR__ . '/../../../models/Client.php');
$clients = Client::get();

// !HEADER
$linkCss = 'clients/clients';
include(__DIR__ . '/../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../views/dashboard/clients/list.php');


// !FOOTER
$jsToCall = 'clientList';
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');