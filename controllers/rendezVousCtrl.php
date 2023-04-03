<?php

// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Slot.php');
require_once(__DIR__ . '/../models/Benefit.php');
require_once(__DIR__ . '/../models/Appointment.php');
require_once(__DIR__ . '/../models/AppointmentBenefit.php');

// GET ALL PRESTATIONS
$prestations = Benefit::get();

// GET ALL SLOTS
$slots = Slot::get();

// Redirect if client is not connected
if (!$clientConnected && !$adminConnected) {
    Flash::flash('forbiddenAccess', 'Il faut être connecté pour accéder à cette partie du site', FLASH_WARNING);
    Flash::flash('accesInfo', 'Si n\'avez pas encore de compte, cliquez sur "Pas encore inscrit ?" pour procéder à l\'inscription', FLASH_INFO);
    header('Location: /Connexion');
    die;
} elseif ($adminConnected) {
    Flash::flash('adminInfo', 'Vous êtes connecté en tant qu\'administrateur du site', FLASH_INFO);
}

// Get id user connected
if ($methodToConnect == 'session') {
    $idClient = $_SESSION['client']->id;
} else {
    $idClient = unserialize($_COOKIE['client'])->id;
}


try {
    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?prestations
        $prestaChecked = filter_input(INPUT_POST, 'prestaCheck', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);

        if (is_null($prestaChecked) || empty($prestaChecked)) {
            $error['presta'] = 'Veuillez sélectionner au moins 1 prestation';
        } elseif (count($prestaChecked) > 3) {
            $error['presta'] = 'Veuillez ne pas sélectionner plus de 3 prestations';
        } elseif (count($prestaChecked) > 0) {
            foreach ($prestaChecked as $presta) {
                if (!Benefit::get($presta)) {
                    $error['presta'] = 'Une prestation sélectionnée n\'a pas de correspondance dans la base de données';
                }
            }
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
            $error['hour'] = 'Vous n\'avez pas renseigné d"heure" pour le rendez-vous !'; // Message d'erreur $hour vide
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
            $appointmentDate = $day . ' ' . $hourMinutes;

            if (strtotime($appointmentDate) < strtotime('now')) {
                $error['minutes'] = 'La date du rendez-vous ne doit pas être antérieure à aujourd\'hui et à l\'instant présent !';
            }
        }

        // if (!empty($error)) {
        //     var_dump($error);
        //     die;
        // }

        // ?No error -> redirect to list page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Connexion à la base de données
            $dbh = Database::connect();
            $dbh->beginTransaction();

            // Nouvelle instance de la class Appointment
            $appointment = new Appointment();
            // Hydratation de l'objet $appointment
            $appointment->setAppointment($appointmentDate);
            $appointment->setId_clients($idClient);
            $resultAppointment = $appointment->add();

            // Ajouter le appointment à la base de donnée & affecter le résultat de l'exécution de la requête à $resultAppointment
            if (!$resultAppointment) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('appointmentAdded', 'Une erreur est survenue lors de l\'ajout du rendez-vous à la base de données');
            } else { //Si pas d'erreur retour à la page liste des rendez-vous

                // Récupérer l'ID du rendez-vous qui vient d'être ajouté
                $idAppointment = $dbh->lastInsertId();

                // Ajouter le rendez-vous avec ses prestations associées à la table appointments_services
                foreach ($prestaChecked as $idPresta) {
                    $result = new AppointmentBenefit($idAppointment, $idPresta);
                    if (!$result) {
                        break 1; //Sort du foreach dès qu'il y a une erreur sur le ADD
                    }
                }
                if ($result && $resultAppointment) {
                    $dbh->commit(); //Validation de la transaction
                    Flash::flash('requestAppointment', 'Votre demande de rendez-vous a été transmise', FLASH_SUCCESS);
                    header('Location: /Accueil');
                    die;
                } else {
                    throw new Exception("Une erreur est survenu lors de l'ajout des prestations sélectionnées au rendez-vous");
                }
            }
        }
        // End if ($_SERVER['REQUEST_METHOD'] == 'POST')

        // Table appointments_services
        // 1 id appmt = 1 id services/prestations
        // 1 id appmt sur plusieurs lignes, idem pour id services
    }
} catch (\Throwable $th) {
    if (isset($dbh)) {
        $dbh->rollBack();
    }
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/templates/errors.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}


// !HEADER
$linkCss = 'rendezVous';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
Flash::flash();
include_once(__DIR__ . '/../views/rendezVous.php');

// !FOOTER
$jsToCall = 'rendezVous';
include_once(__DIR__ . '/../views/templates/footer.php');
