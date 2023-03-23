<?php
session_start();

// Appel des fonctions FLASH
require_once(__DIR__ . '/../../../helpers/flash.php');

// Appel des CONSTANTES
require_once(__DIR__ . '/../../../config/constants.php');

// Appel du MODELE
require_once(__DIR__ . '/../../../models/Client.php');

try {

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?LASTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($lastname)) { //Si $lastname est vide
            $error['lastname'] = 'Vous n\'avez pas renseigné le "Nom"'; // Message d'erreur lastname vide
        } elseif (!filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_LASTNAME . '/')))) { //Sinon si $lastname ne correspond pas à un format lastname
            $error['lastname'] = 'Le nom ne correspond pas au format requis pour un nom'; //Message d'erreur lastname format
        }
        if (empty($error['lastname'])) {
            $lastname = ucfirst(strtolower($lastname));
        }

        // ?FIRSTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($firstname)) { //Si $firstname est vide
            $error['firstname'] = 'Vous n\'avez pas renseigné le "Prénom"'; // Message d'erreur firstname vide
        } elseif (!filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_FIRSTNAME . '/')))) { //Sinon si $firstname ne correspond pas à un format firstname
            $error['firstname'] = 'Le prénom ne correspond pas au format requis pour un prénom'; //Message d'erreur firstname format
        }
        if (empty($error['firstname'])) {
            $firstname = ucfirst(strtolower($firstname));
        }

        // ?EMAIL
        // Double nettoyage de l'email
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        // Validation des données
        if (empty($email)) { //Si $email est vide
            $error['email'] = 'L\'email n\'est pas renseigné'; //Message d'erreur EMAIL
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Sinon si $email ne correspond pas à un format d'adresse email
            $error['email'] = 'L\'email ne correspond pas au format requis pour un email'; //Message d'erreur EMAIL format
        }
        if (empty($error['email'])) {
            $email = strtolower($email);
        }

        // ?PASSWORD
        // Nettoyage du mot de passe
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($password)) { //Si $password est vide
            $error['password'] = 'Le mot de passe n\'est pas renseigné'; //Message d'erreur password
        } elseif (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_PASSWORD . '/')))) { //Sinon si $password ne correspond pas à un format lastname
            $error['password'] = 'Le mot de passe ne correspond pas au format requis pour un mot de passe (1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial au minimum, entre 6 et 15 caractères)'; //Message d'erreur password format
        }
        // HACHAGE
                // Encodage du mot de passe
                // $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        // ?PHONE NUMBER
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);

        // Validation des données
        if (empty($phone)) {
            $error['phone'] = 'Le numéro de téléphone n\'est pas renseigné ! ';
        } else {
            if (!filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_PHONE_NUMBER . '/')))) { //Sinon si $phone ne correspond pas à un format numéro de téléphone
                $error["phone"] = 'Le téléphone ne correspond pas au format requis pour un numéro de téléphone francais'; //Message d'erreur numéro de téléphone format
            }
        }

        // ?BIRTHDATE
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($birthdate)) { //Si $birthdate est vide
            $error["birthdate"] = 'La date de naissance n\'est pas renseigné'; //Message d'erreur birthdate
        } elseif (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_BIRTHDATE . '/')))) { //Sinon si $url ne correspond pas à un format url
            $error["birthdate"] = 'La date de naissance n\'est pas valide'; //Message d'erreur birthdate
        }

        // Vérification que le client existe pas déja avec la méthode isExist()
        // if (!Client::isExist($lastname, $firstname, $email, $birthdate)) { //Si le patient existe déjà en base de données
        //     flash('clientExist', 'Ce client existe déjà !', FLASH_DANGER); //Création d'un flash avec le message à afficher 
        //     $error['client'] = 'Ce client existe déjà !';
        // }
        // ?No error -> redirect to home page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Nouvelle instance de la class Client
            $client = new Client();
            // Hydratation de l'objet $client
            $client->setLastname($lastname);
            $client->setFirstname($firstname);
            $client->setEmail($email);
            $client->setPassword($password);
            $client->setPhone($phone);
            $client->setBirthdate($birthdate);

            // Ajouter le client à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $client->add();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('clientAdded', 'Une erreur est survenue lors de l\'ajout du client à la base de données');
            } else { //Si pas d'erreur retour à la page d'Accueil
                Flash::flash('clientAdded', 'Patient ajouté avec succès', FLASH_SUCCESS);
                header('location: /Dashboard');
                die;
            }
        }

        // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
    }
} catch (\Throwable $th) {
    include(__DIR__ . '/../../../views/dashboard/templates/header.php');
    include(__DIR__ . '/../../../views/templates/errors.php');
    include(__DIR__ . '/../../../views/dashboard/templates/footer.php');
    die;
}

// Appel du header
$linkCss = 'clients/add';
include(__DIR__ . '/../../../views/dashboard/templates/header.php');

// Appel de la view
include(__DIR__ . '/../../../views/dashboard/clients/add.php');

// Appel du footer
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');
