<?php

// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Slot.php');
require_once(__DIR__ . '/../models/Benefit.php');

// GET ALL PRESTATIONS
$prestations = Benefit::get();

// GET ALL SLOTS
$slots = Slot::get();


// *VERIFICATIONS DES DONNEES DU FORMULAIRE 
// *PUIS REDIRECTION SI DONNEES VALIDEES
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST
    
    // ?prestations
    var_dump($_POST['prestaCheck']);
    $prestaChecked = filter_input(INPUT_POST, 'prestaCheck', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
    
    var_dump($prestaChecked);die;
    try {

        // ?day
        // Nettoyage de tout les caractères ASCII 1 à 32
        $day = trim(filter_input(INPUT_POST, 'day', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($day)) { //Si $day est vide
            $error['day'] = 'Vous n\'avez pas renseigné de "jour" pour le rendez-vous !'; // Message d'erreur $day vide
        } elseif (!filter_var($day, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_APPOINTMENT_DAY . '/')))) { //Sinon si $day ne correspond pas à un format YYYY-MM-DD
            $error['day'] = 'Le jour du rendez-vous ne correspond pas au format requis pour un rendez-vous !'; //Message d'erreur day format
        }

        // ?hour/minutes
        // Nettoyage de tout les caractères ASCII 1 à 32
        $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_NUMBER_INT));
        $minutes = trim(filter_input(INPUT_POST, 'minutes', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($hour)) { //Si $hour est vide
            $error['hour'] = 'Vous n\'avez pas renseigné d\'"heure" pour le rendez-vous !'; // Message d'erreur $hour vide
        }
        if (empty($minutes)) {
            $error['minutes'] = 'Vous n\avez pas renseigné les "minutes" pour le rendez-vous'; // Message d'erreur $minutes vide
        }
        if (!isset($error['hour']) && !isset($error['minutes'])) { // Si pas d'erreur pour $hour et $minutes 

            // Concaténer heure et minutes
            $hourMinutes = $hour . ':' . $minutes;
            if (!filter_var($hourMinutes, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_SLOT . '/')))) { //Sinon si $hourMinutes ne correspond pas à un format HH:ii
                $error['minutes'] = 'Les heures et minutes du rendez-vous ne correspondent pas au format requis pour un rendez-vous !'; //Message d'erreur hourMinutes format
            }
        }

        if (!isset($error['day']) && !isset($error['hour']) && !isset($error['minutes'])) {
            // Concaténer day & hourMinutes to day.T.hourMinutes
            $appointmentDate = $day . ' ' . $hourMinutes;

            if (strtotime($appointmentDate) < strtotime('now')) {
                $error['minutes'] = 'La date du rendez-vous ne doit pas être antérieure à aujourd\'hui et à l\'instant présent !';
            }
        }
    
} catch (\Throwable $th) {
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/templates/errors.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}}


// !HEADER
$linkCss = 'rendezVous';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
include_once(__DIR__ . '/../views/rendezVous.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
