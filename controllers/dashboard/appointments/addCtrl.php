<?php

// !INIT
require_once(__DIR__ . '/../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../models/Appointment.php');
require_once(__DIR__ . '/../../../models/Client.php');
require_once(__DIR__ . '/../../../models/Slot.php');

// GET ALL CLIENTS
$clients = Client::get();

// GET ALL SLOTS
$slots = Slot::get();

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

        // ?day
        // Nettoyage de tout les caractères ASCII 1 à 32
        $day = trim(filter_input(INPUT_POST, 'day', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($day)) { //Si $day est vide
            $error['day'] = 'Vous n\'avez pas renseigné de "jour" pour le rendez-vous !'; // Message d'erreur $day vide
        } elseif (!filter_var($day, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_APPOINTMENT_DAY . '/')))) { //Sinon si $day ne correspond pas à un format YYYY-MM-DD
            $error['day'] = 'Le jour du rendez-vous ne correspond pas au format requis pour un rendez-vous !'; //Message d'erreur day format
        }

        // ?hour/minutes
        // Nettoyage de tout les caractères ASCII 1 à 32
        $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_NUMBER_INT));
        $minutes = trim(filter_input(INPUT_POST, 'minutes', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($hour)) { //Si $hour est vide
            $error['hour'] = 'Vous n\'avez pas renseigné d\'"heure" pour le rendez-vous !'; // Message d'erreur $hour vide
        }
        if (empty($minutes)) {
            $error['minutes'] = 'Vous n\avez pas renseigné les "minutes" pour le rendez-vous'; // Message d'erreur $minutes vide
        }
        if (!isset($error['hour']) && !isset($error['minutes'])) { // Si pas d'erreur pour $hour et $minutes 

            // Concaténer heure et minutes
            $hourMinutes = $hour . ':' . $minutes;
            if (!filter_var($hourMinutes, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_SLOT . '/')))) { //Sinon si $hourMinutes ne correspond pas à un format HH:ii
                $error['minutes'] = 'Les heures et minutes du rendez-vous ne correspondent pas au format requis pour un rendez-vous !'; //Message d'erreur hourMinutes format
            } 
        }
        
        if (!isset($error['day']) && !isset($error['hour']) && !isset($error['minutes'])) {
            // Concaténer day & hourMinutes to day.T.hourMinutes
            $appointmentDate = $day.' '.$hourMinutes;
            
            if (strtotime($appointmentDate) < strtotime('now')) {
                $error['minutes'] = 'La date du rendez-vous ne doit pas être antérieure à aujourd\'hui et à l\'instant présent !';
            }
        }

        // Vérification que le rendez-vous n'existe pas déja avec la méthode isExist()
        if (Appointment::isExist($appointmentDate)) { //Si le rendez-vous existe déjà en base de données
            Flash::flash('appointmentAdded', 'Ce rendez-vous est déjà pris !', FLASH_DANGER); //Création d'un flash avec le message à afficher 
            $error['minutes'] = 'Ce rendez-vous est déjà pris !';
        }
        
        if (!empty($error)) {
            var_dump($error);die;
        }

        // ?No error -> redirect to list page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Nouvelle instance de la class Appointment
            $appointment = new Appointment();
            // Hydratation de l'objet $appointment
            $appointment->setAppointment($appointmentDate);
            $appointment->setId_clients($idClients);

            // Ajouter le appointment à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $appointment->add();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('appointmentAdded', 'Une erreur est survenue lors de l\'ajout du rendez-vous à la base de données');
            } else { //Si pas d'erreur retour à la page liste des rendez-vous
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
Flash::flash();
include(__DIR__ . '/../../../views/dashboard/appointments/add.php');

// !FOOTER
include(__DIR__ . '/../../../views/dashboard/templates/footer.php');
