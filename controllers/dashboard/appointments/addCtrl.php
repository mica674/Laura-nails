<?php
session_start();

// !FLASH
require_once(__DIR__ . '/../../../helpers/flash.php');

// !CONSTANTS
require_once(__DIR__ . '/../../../config/constants.php');

// !MODELS
require_once(__DIR__ . '/../../../models/Appointment.php');
require_once(__DIR__ . '/../../../models/Client.php');

$clients = Client::get();

try {

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?idClients
        // Nettoyage de tout les caractères ASCII 1 à 32
        $idClients = intval(filter_input(INPUT_POST, 'idClients', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($idClients)) { //Si $idClients est vide
            $error['idClients'] = 'Vous n\'avez pas renseigné de "Patient"'; // Message d'erreur $idClients vide
        } elseif (!filter_var($idClients, FILTER_VALIDATE_INT)) { //Sinon si $idClients ne correspond pas à un format int
            $error['idClients'] = 'le nom du patient ne correspond pas au format requis pour un patient'; //Message d'erreur idClients format
        }
        
        // ?dateHour
        // Nettoyage de tout les caractères ASCII 1 à 32
        $dateHour = trim(filter_input(INPUT_POST, 'appointment', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($dateHour)) { //Si $dateHour est vide
            $error['dateHour'] = 'Vous n\'avez pas renseigné de "date de rendez-vous" !'; // Message d'erreur $dateHour vide
        } elseif (!filter_var($dateHour, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_APPOINTMENT . '/')))) { //Sinon si $dateHour ne correspond pas à un format datetime
            $error['dateHour'] = 'Date du rendez-vous ne correspond pas au format requis pour un rendez-vous !'; //Message d'erreur dateHour format
        } elseif (strtotime($dateHour) < strtotime('now')) {
            $error['dateHour'] = 'Date de rendez-vous antérieure à aujourd\'hui !';
        }

        // Vérification que le rendez-vous n'existe pas déja avec la méthode isExist()
        if (Appointment::isExist($dateHour)) { //Si le rendez-vous existe déjà en base de données
            Flash::flash('appointmentAdded', 'Ce rendez-vous est déjà pris !', FLASH_DANGER); //Création d'un flash avec le message à afficher 
            $error['appointment'] = 'Ce rendez-vous est déjà pris !';
        }
        // ?No error -> redirect to home page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Nouvelle instance de la class Appointment
            $appointment = new Appointment();
            // Hydratation de l'objet $appointment
            $appointment->setDateHour($dateHour);
            $appointment->setIdClients($idClients);

            // Ajouter le appointment à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $appointment->add();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('appointmentAdded', 'Une erreur est survenue lors de l\'ajout du rendez-vous à la base de données');
            } else { //Si pas d'erreur retour à la page d'Accueil
                Flash::flash('appointmentAdded', 'Rendez-vous ajouté avec succès', FLASH_SUCCESS);
                header('location: /Dashboard/Appointments/List');
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

// !HEADER
$linkCss = 'appointments/add';
include(__DIR__ . '/../../../views/dashboard/templates/header.php');

// !VIEWS
include(__DIR__ . '/../../../views/dashboard/appointments/add.php');

// !FOOTER
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');
