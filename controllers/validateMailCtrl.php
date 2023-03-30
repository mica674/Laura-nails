<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Client.php');

$email = trim(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL));
$isValidate = Client::validateMail($email);

if (!empty($email)) {
    // Récupère les infos du client lié à cette adresse email pour pouvoir le connecté directement
    $client = Client::getByEmail($email);

    // Connexion du client en session
    $_SESSION['client'] = $client;
    unset($_SESSION['client']->password);

    // Message flash
    Flash::flash('emailValidated', 'Votre compte a bien été validé, vous êtes connecté !', FLASH_SUCCESS);
} else {
    // Message flash
    Flash::flash('emailValidated', 'Une erreur est survenue lors de la validation', FLASH_DANGER);
}

// Redirection vers la page d'accueil
header('Location: /Accueil');
die;
