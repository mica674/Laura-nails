<?php

// !CONSTANTES
require_once(__DIR__ . '/../config/constants.php');

// !MODELS
require_once(__DIR__ . '/../models/Slot.php');

// GET ALL SLOTS
$slots = Slot::get();

// !HEADER
$linkCss = 'rendezVous';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
include_once(__DIR__ . '/../views/rendezVous.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
