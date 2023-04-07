<?php
// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Comment.php');
require_once(__DIR__ . '/../../../../models/Client.php');

// Récupérer tous les avis
$reviews = Comment::getAll();


// !HEADER
$linkCss = 'pages/reviews';
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../../views/dashboard/pages/reviews/list.php');


// !FOOTER
$jsToCall = 'reviewsList';
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');