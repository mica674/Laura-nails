<?php

// *CONSTANTES
require_once(__DIR__ . '/../config/constants.php');

// *VERIFICATIONS DES DONNEES DU FORMULAIRE 
// *PUIS REDIRECTION SI DONNEES VALIDEES
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

    // ?LASTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validation des données
        if (empty($lastname)) { //Si $lastname est vide
            $error['lastname'] = 'Vous n\'avez pas renseigné votre "Nom"'; // Message d'erreur lastname vide
        } elseif (!(filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_LASTNAME . '/'))))) { //Sinon si $lastname ne correspond pas à un format lastname
            $error["lastname"] = 'Le nom ne correspond pas au format requis pour un nom'; //Message d'erreur lastname format
        }

    // ?FIRSTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Validation des données
        if (empty($firstname)) { //Si $firstname est vide
            $error['firstname'] = 'Vous n\'avez pas renseigné votre "Prénom"'; // Message d'erreur firstname vide
        } elseif (!(filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_FIRSTNAME . '/'))))) { //Sinon si $firstname ne correspond pas à un format firstname
            $error["firstname"] = 'Le nom ne correspond pas au format requis pour un prénom'; //Message d'erreur firstname format
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
    
    // ?BIRTHDAY
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $birthday = trim(filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_NUMBER_INT));

        // Validation de la date de naissance
        if (!filter_var($birthday, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_BIRTHDAY . '/')))) { //Sinon si $url ne correspond pas à un format url
            $error["birthday"] = 'La date de naissance n\'est pas valide'; //Message d'erreur url format
        }

    // ?No error -> redirect to home page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations
            // Enregistrement des données en cookies
            setcookie('lastname', $lastname, time()+86400*365*2);
            setcookie('firstname', $firstname, time()+86400*365*2);
            setcookie('email', $email, time()+86400*365*2);
            setcookie('password', $password, time()+86400*365*2);
            setcookie('phoneNumber', $phoneNumber, time()+86400*365*2);

            if (isset($birthday)) {
                setcookie('birthday', $birthday, time()+86400*365*2);
            }
            header('location: /controllers/loginCtrl.php?regist1='.$lastname.'&regist2='.$firstname.'&regist3='.$email.'&regist4='.$password.'&regist5='.$phoneNumber.'&regist6='.$birthday??'');
            die;
        }

// End if ($_SERVER['REQUEST_METHOD'] == 'POST')
}

// Si au moins un des cookies en lien avec l'inscription existe alors les affectés à la variable correspondante
if (isset($_COOKIE['lastname']) || isset($_COOKIE['firstname']) || isset($_COOKIE['email']) || isset($_COOKIE['password']) || isset($_COOKIE['$phoneNumber']) || isset($_COOKIE['$birthday'])) {
    $lastname = $_COOKIE['lastname']??'';
    $firstname = $_COOKIE['firstname']??'';
    $email = $_COOKIE['email']??'';
    $password = $_COOKIE['password']??'';
    $phoneNumber = $_COOKIE['phoneNumber']??'';
    $birthday = $_COOKIE['birthday']??'';
}


// !HEADER
$linkCss = 'registration';
include_once(__DIR__ . '/../views/templates/header.php');

include_once(__DIR__ . '/../views/registrer.php');



// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
