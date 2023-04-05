<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Comment.php');
require_once(__DIR__ . '/../models/Client.php');

// Récupérer les 5 derniers commentaires postés
$last5Comments = Comment::get();

// !HEADER
$linkCss = 'home';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/home.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
