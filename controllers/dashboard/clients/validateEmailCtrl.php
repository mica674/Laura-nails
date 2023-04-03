<?php
// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../models/Client.php');

$email = trim(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL));
$isValidate = Client::validateMail($email);

if (!empty($email)) {
    // Récupère les infos du client lié à cette adresse email pour pouvoir le connecté directement
    $client = Client::getByEmail($email);

    // Message flash
    Flash::flash('emailValidated', 'Le compte a bien été validé !', FLASH_SUCCESS);
} else {
    // Message flash
    Flash::flash('emailValidated', 'Une erreur est survenue lors de la validation', FLASH_DANGER);
}

// Redirection vers la page de la liste des clients du dashboard
header('Location: /Dashboard/Clients/List');
die;
