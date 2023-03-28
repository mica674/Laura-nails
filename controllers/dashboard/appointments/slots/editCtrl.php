<?php
session_start();
// !CONSTANTS
require_once(__DIR__ . '/../../../../config/constants.php');

// !FLASH
require_once(__DIR__ . '/../../../../helpers/flash.php');

// !MODEL
require_once(__DIR__ . '/../../../../models/Slot.php');

// Récupérer l'id passé en GET avec le filtrage au passge
$idSlot = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
if (empty($idSlot)) {
    Flash::flash('slotEdited', 'Ce créneau n\'existe pas', FLASH_DANGER);
    header('Location: /Dashboard/Appointments/Slots/List');
    exit;
}else {
    // Appel de la méthode static get de la class Slot pour récupérer les infos du slot 
    $slot = Slot::get($idSlot);
}


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
    // Mettre en minuscule tous les caractères et en majuscule le premier caractère
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
    // Mettre en minuscule tous les caractères et en majuscule le premier caractère
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
    // Mettre en minuscule tous les caractères
    if (empty($error['email'])) {
        $email = strtolower($email);
    }


    // ?PHONE NUMBER
    // Nettoyage des caractères autres que les chiffres & '+' & '-'
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);


    // Validation des données
    if (!empty($phone)) {
        if (!filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_PHONE_NUMBER . '/')))) { //Sinon si $phone ne correspond pas à un format numéro de téléphone
            $error["phone"] = 'Le téléphone ne correspond pas au format requis pour un numéro de téléphone francais'; //Message d'erreur numéro de téléphone format
        }
    }


    // ?BIRTHDATE
    // Nettoyage des caractères autres que les chiffres & '+' & '-'
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));


    if (empty($birthdate)) { //Si $birthdate est vide
        $error["birthdate"] = 'La date de naissance n\'est pas renseigné'; //Message d'erreur birthdate
    } elseif (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_BIRTHDATE . '/')))) { //Sinon si $url ne correspond pas à un format url
        $error["birthdate"] = 'La date de naissance n\'est pas valide'; //Message d'erreur birthdate
    }


    // ?Compare with previous values and new values
    if (($lastname != $client->lastname
            ||  $firstname != $client->firstname
            ||  $email != $client->email
            ||  $birthdate != $client->birthdate
        )
        && Client::isClientExist($lastname, $firstname, $email, $birthdate)
    ) {
        $error['exist'] = 'Un client a déjà ces informations dans la base de données ! ';
        Flash::flash('slotEdited', 'Un client a déjà ces informations dans la base de données !', FLASH_DANGER);
    }
    // ?No error -> redirect to clientsList page
    if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations


        $client = new client();
        $client->setId(intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
        $client->setLastname($lastname);
        $client->setFirstname($firstname);
        $client->setEmail($email);
        if (isset($phone)) {
            $client->setPhone($phone);
        } else {
            $client->setPhone('');
        }
        $client->setBirthdate($birthdate);
        // Vérification que le client existe pas déja avec la méthode notAlreadyExist()
        // Ajouter du client à la base de donnée & affecter le résultat de l'exécution de la requête à $result
        $result = $client->update();
        if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
            Flash::flash('slotEdited', 'La modification du client a échoué', FLASH_DANGER);
        } else { //Si pas d'erreur retour à la page d'Accueil
            Flash::flash('slotEdited', 'La modification du client a réussi, bravo', FLASH_SUCCESS);
            header('Location: /Dashboard/Clients/List');
            die;
        }
    }


    // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
}





// !HEADER
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');


// !VIEW
FLASH::flash();
include(__DIR__ . '/../../../../views/dashboard/appointments/slots/edit.php');


// !FOOTER
// Fichiers JS à appeler dans le footer
$jsToCall = 'slotEdit';
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');
