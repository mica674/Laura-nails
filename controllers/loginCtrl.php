<?php

// *CONSTANTES
require_once(__DIR__ . '/../config/constants.php');

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
    
    // ?PASSWORD
        // Nettoyage du mot de passe
        $password = filter_input(INPUT_POST, 'password');

        if (empty($password)) {
            $error['password'] = 'Le mot de passe est vide';
        } else {
            if (!filter_var($password, FILTER_VALIDATE_REGEXP,  array("options" => array("regexp" => '/' . REGEXP_PASSWORD . '/')))
            ) {
                $error['password'] = 'Le mot de passe renseigné n\'est pas correct';
            }
        }

        // Encodage du mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    // ?No error -> redirect to home page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations
            // Enregistrement des données en cookies
            setcookie('email', $email, time()+86400*365*2);
            setcookie('password', $password, time()+86400*365*2);

            header('location: /Accueil?login1='.$email.'&login2='.$password);
            die;
        }

// End if ($_SERVER['REQUEST_METHOD'] == 'POST')
}

if (isset($_COOKIE['email']) || isset($_COOKIE['password'])) {
    $email = $_COOKIE['email']??'';
    $password = $_COOKIE['password']??'';
}


    // !HEADER
    $linkCss = 'login';
    include_once(__DIR__ . '/../views/templates/header.php');

    include_once(__DIR__ . '/../views/login.php');



// FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
