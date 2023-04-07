<?php

// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Contact.php');

// Informations de l'utilisateur connecté

try {

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?CONTACT's TITLE
        // Nettoyage de tout les caractères ASCII 1 à 32
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($title)) { //Si $title est vide
            $error['title'] = 'Vous n\'avez pas renseigné le "Titre" de l\'avis'; // Message d'erreur title vide
        } elseif (!(filter_var($title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_TITLE . '/'))))) { //Sinon si $title ne correspond pas à un format title
            $error["title"] = 'Le titre ne correspond pas au format requis pour un titre'; //Message d'erreur title format
        }
        if (empty($error['title'])){
            $title = ucfirst(strtolower($title));
        }
        
        // ?CONTACT's MESSAGE
        // Nettoyage de tout les caractères ASCII 1 à 32
        $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($message)) { //Si $message est vide
            $error['message'] = 'Vous n\'avez pas renseigné le "Message" de l\'avis'; // Message d'erreur message vide
        } elseif (!(filter_var($message, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_MESSAGE . '/'))))) { //Sinon si $message ne correspond pas à un format message
            $error["message"] = 'Le message ne correspond pas au format requis pour un message'; //Message d'erreur message format
        }

        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Nouvelle instance de la class Contact
            $contact = new Contact();
            // Hydratation de l'objet $contact
            $contact->setFirstname($firstname);
            $contact->setEmail($email);
            $contact->setTitle($title);
            $contact->setContent($message);
            // Si l'utilisateur est connecté on associe son id_clients pour simplifié la récupération d'information plus tard
            if ($userConnected = true) {
                $contact->setId_clients($methodToConnect=='session'?$_SESSION['client']->id:unserialize($_COOKIE['client'])->id);
            }

            // Ajouter le contact à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $contact->add();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('contactAdded', 'Une erreur est survenue lors de l\'envoi du message');
            } else { //Si pas d'erreur retour à la page d'Accueil
                Flash::flash('contactAdded', 'Message envoyé avec succès', FLASH_SUCCESS);
                header('location: /Accueil');
                die;
            }
        }

        // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
    }
} catch (\Throwable $th) {
    include_once(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/templates/errors.php');
    include_once(__DIR__ . '/../views/templates/footer.php');
    die;
}

// !HEADER
$linkCss = 'contact';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/contact.php');

// !FOOTER
include_once(__DIR__ . '/../views/templates/footer.php');
