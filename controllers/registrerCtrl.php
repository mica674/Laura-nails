<?php

// !CONSTANTS
require_once(__DIR__ . '/../config/constants.php');

// !MODELS
require_once(__DIR__ . '/../models/Client.php');

try {

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?LASTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($lastname)) { //Si $lastname est vide
            $error['lastname'] = 'Vous n\'avez pas renseigné votre "Nom"'; // Message d'erreur lastname vide
        } elseif (!(filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_LASTNAME . '/'))))) { //Sinon si $lastname ne correspond pas à un format lastname
            $error["lastname"] = 'Le nom ne correspond pas au format requis pour un nom'; //Message d'erreur lastname format
        }
        if (empty($error['lastname'])){
            $lastname = ucfirst(strtolower($lastname));
        }

        // ?FIRSTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($firstname)) { //Si $firstname est vide
            $error['firstname'] = 'Vous n\'avez pas renseigné votre "Prénom"'; // Message d'erreur firstname vide
        } elseif (!(filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_FIRSTNAME . '/'))))) { //Sinon si $firstname ne correspond pas à un format firstname
            $error["firstname"] = 'Le nom ne correspond pas au format requis pour un prénom'; //Message d'erreur firstname format
        }
        if (empty($error['firstname'])){
            $firstname = ucfirst(strtolower($firstname));
        }

        // ?EMAIL
        // Double nettoyage de l'email
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        // Validation des données
        if (empty($email)) { //Si $email est vide
            $error["email"] = 'L\'email n\'est pas renseigné'; //Message d'erreur EMAIL
        } elseif (!(filter_var($email, FILTER_VALIDATE_EMAIL))) { //Sinon si $email ne correspond pas à un format d'adresse email
            $error["email"] = 'L\'email ne correspond pas au format requis pour un email'; //Message d'erreur EMAIL format
        }
        if (empty($error['email'])){
            $email = strtolower($email);
        }

        // ?PASSWORD
        // Nettoyage du mot de passe
        $password = filter_input(INPUT_POST, 'password');
        $confirmedPassword = filter_input(INPUT_POST, 'confirmedPassword');

        if (empty($password) || empty($confirmedPassword)) {
            $error['password'] = 'Au moins un des champs de mot de passe est vide';
        } else {
            if ($password != $confirmedPassword) {
                $error['password'] = 'Les mots de passe ne sont pas identiques';
            } else {
                if (
                    !filter_var($password, FILTER_VALIDATE_REGEXP,  array("options" => array("regexp" => '/' . REGEXP_PASSWORD . '/')))
                    && !filter_var($confirmedPassword, FILTER_VALIDATE_REGEXP,  array("options" => array("regexp" => '/' . REGEXP_PASSWORD . '/')))
                ) {
                    $error['password'] = 'Le mot de passe renseigné n\'est pas correct';
                }
            }
        }
        // Encodage du mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // ?PHONE NUMBER
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $phoneNumber = trim(filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT));

        if (empty($phoneNumber)) { //Si $phoneNumber est vide
            $error["phoneNumber"] = 'Le numéro de téléphone n\'est pas renseigné'; //Message d'erreur phoneNumber
        } elseif (!filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_PHONE_NUMBER . '/')))) { //Sinon si $phoneNumber ne correspond pas à un format numéro de téléphone
            $error["phoneNumber"] = 'Le code postal ne correspond pas au format requis pour un numéro de téléphone francais'; //Message d'erreur numéro de téléphone format
        }

        // ?BIRTHDATE
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));

        // Validation de la date de naissance
        if (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_BIRTHDATE . '/')))) { //Sinon si $url ne correspond pas à un format url
            $error["birthdate"] = 'La date de naissance n\'est pas valide'; //Message d'erreur url format
        }

        // ?No error -> redirect to login page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations
            // Enregistrement des données en cookies
            setcookie('lastname', $lastname, time() + 86400 * 365 * 2);
            setcookie('firstname', $firstname, time() + 86400 * 365 * 2);
            setcookie('email', $email, time() + 86400 * 365 * 2);
            setcookie('password', $password, time() + 86400 * 365 * 2);
            setcookie('phoneNumber', $phoneNumber, time() + 86400 * 365 * 2);

            if (isset($birthdate)) {
                setcookie('birthdate', $birthdate, time() + 86400 * 365 * 2);
            }
            header('location: /Connexion?regist1=' . $lastname . '&regist2=' . $firstname . '&regist3=' . $email . '&regist4=' . $password . '&regist5=' . $phoneNumber . '&regist6=' . $birthdate ?? '');
            die;
        }

        // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
    }

    // Si au moins un des cookies en lien avec l'inscription existe alors les affectés à la variable correspondante
    if (isset($_COOKIE['lastname']) || isset($_COOKIE['firstname']) || isset($_COOKIE['email']) || isset($_COOKIE['password']) || isset($_COOKIE['$phoneNumber']) || isset($_COOKIE['$birthdate'])) {
        $lastname = $_COOKIE['lastname'] ?? '';
        $firstname = $_COOKIE['firstname'] ?? '';
        $email = $_COOKIE['email'] ?? '';
        $password = $_COOKIE['password'] ?? '';
        $phoneNumber = $_COOKIE['phoneNumber'] ?? '';
        $birthdate = $_COOKIE['birthdate'] ?? '';
    }
} catch (\Throwable $th) {
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/templates/errors.php');
    include(__DIR__ . '/../views/templates/footer.php');
}

// !HEADER
$linkCss = 'registration';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEW
include_once(__DIR__ . '/../views/registrer.php');



// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
