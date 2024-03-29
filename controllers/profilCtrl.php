<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Client.php');

// Récupérer l'id passé en GET avec le filtrage au passge
// Get id user connected
if ($methodToConnect == 'session') {
    $idClient = $_SESSION['client']->id;
} else {
    $idClient = unserialize($_COOKIE['client'])->id;
}

if (empty($idClient)) {
    Flash::flash('clientProfil', 'Ce client n\'existe pas', FLASH_DANGER);
    header('Location: /Accueil');
    exit;
} else {
    // Appel de la méthode static get de la class Client pour récupérer les infos du client 
    $client = Client::get($idClient);
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


    if (!empty($birthdate)) { //Si $birthdate est vide
    if (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_BIRTHDATE . '/')))) { //Sinon si $url ne correspond pas à un format url
        $error["birthdate"] = 'La date de naissance n\'est pas valide'; //Message d'erreur birthdate
    }}


    // ?Compare with previous values and new values
    if (($lastname != $client->lastname
            ||  $firstname != $client->firstname
            ||  $email != $client->email
            ||  $birthdate != $client->birthdate
        )
        && Client::isClientExist($lastname, $firstname, $email, $birthdate)
    ) {
        $error['exist'] = 'Un client a déjà ces informations dans la base de données ! ';
        Flash::flash('clientEdited', 'Un client a déjà ces informations dans la base de données !', FLASH_DANGER);
    }

    if ($lastname == $client->lastname
    &&  $firstname == $client->firstname
    &&  $email == $client->email
    &&  $birthdate == $client->birthdate) {
        $error['idem'] = 'Pas de modification';
        Flash::flash('clientEdited', 'Pas de modification de vos informations', FLASH_WARNING);
    }

    // ?No error -> redirect to clientsList page
    if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations


        $clientObj = new client();
        $clientObj->setId($idClient);
        $clientObj->setLastname($lastname);
        $clientObj->setFirstname($firstname);
        $clientObj->setEmail($email);
        if (isset($phone)) {
            $clientObj->setPhone($phone);
        } else {
            $clientObj->setPhone('');
        }
        $clientObj->setBirthdate($birthdate);
        // Ajouter du client à la base de donnée & affecter le résultat de l'exécution de la requête à $result
        $result = $clientObj->update();
        if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
            Flash::flash('clientEdited', 'Les modifications ont échoué', FLASH_DANGER);
        } else { //Si pas d'erreur retour à la page d'Accueil
            Flash::flash('clientEdited', 'Les modifications ont bien été prises en compte', FLASH_SUCCESS);
            // Mise à jour des infos du client
            $client = Client::get($idClient);
        }
    }


    // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
}





// !HEADER
$linkCss = 'profil';
include(__DIR__ . '/../views/templates/header.php');


// !VIEW
FLASH::flash();
include(__DIR__ . '/../views/profil.php');

// !FOOTER
// Fichiers JS à appeler dans le footer
$jsToCall = 'profil';
include(__DIR__ . '/../views/templates/footer.php');
