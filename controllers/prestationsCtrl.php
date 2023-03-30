<?php

// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Benefit.php');

// Récupérer toutes les prestations
$prestations = Benefit::get();

// !HEADER
$linkCss = 'prestations';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
include_once(__DIR__ . '/../views/prestations.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
