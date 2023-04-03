<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');


// !MODELS
require_once(__DIR__ . '/../models/Client.php');


// *VERIFICATIONS DES DONNEES DU FORMULAIRE 
// *PUIS REDIRECTION SI DONNEES VALIDEES
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

    // ?EMAIL
    // Double nettoyage de l'email
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    // Validation des données
    if (empty($email)) { //Si $email est vide
        $error["email"] = 'L\'email n\'est pas renseigné'; //Message d'erreur EMAIL
    } elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) { //Sinon si $email ne correspond pas à un format d'adresse email
        $error["email"] = 'L\'email ne correspond pas au format requis pour un email'; //Message d'erreur EMAIL format
    }


    $clientCompare = Client::getByEmail($email);
    if (empty($clientCompare)) {
        $error["global"] = 'L\'email et/ou le mot de passe ne correspondent pas à des identifiants valides';
    } elseif (!$clientCompare->validated_at) {
        $error["email"] = 'Vous n\avez pas encore validé votre email';
    }

    // ?PASSWORD
    // Nettoyage du mot de passe
    $password = filter_input(INPUT_POST, 'password');

    if (empty($password)) {
        $error['password'] = 'Le mot de passe est vide';
    } else {
        if (!filter_var($password, FILTER_VALIDATE_REGEXP,  array("options" => array("regexp" => '/' . REGEXP_PASSWORD . '/')))) {
            $error['password'] = 'Le mot de passe renseigné n\'est pas correct';
        } elseif (!password_verify($password, $clientCompare->password)) {
            $error['global'] = 'L\'email et/ou le mot de passe ne correspondent pas à des identifiants valides';
        }
    }

    // ?STAY CONNECTED
    // Nettoyage de la valeur de la checkbox
    $stayConnected = filter_input(INPUT_POST, 'stayConnected', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($stayConnected)) {
        $stayConnected = false;
    }


    // ?No error -> redirect to home page
    if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

        
        $client = Client::getByEmail($email);
        unset($client->password);
        // Si la case restés connecté a été cochée on passe la connexion en cookie sinon en session
        if ($stayConnected) {
            // Mise en cookie de la connexion du client
            setcookie('client', serialize($client), time() + 86400 * 365 * 1); //Durée = 1 an
        } else {
            // Mise en session de la connexion du client
            $_SESSION['client'] = $client;
        }
        
        // Message flash
        Flash::flash('clientConnected', 'Vous êtes connecté', FLASH_INFO);
        
        if ($client->adminADMIN == 1) {
            header('Location: /Dashboard');die;
        } else {    
            header('Location: /Accueil');
            die;
        }
    }

    // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
}

if (isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
    $email = $_COOKIE['email'] ?? '';
    $password = $_COOKIE['password'] ?? '';
}


// !HEADER
$linkCss = 'login';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/login.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
