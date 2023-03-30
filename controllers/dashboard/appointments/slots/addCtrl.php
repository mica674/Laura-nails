<?php
// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Appointment.php');
require_once(__DIR__ . '/../../../../models/Slot.php');

try {
    
    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?slotStart
        // Nettoyage de tout les caractères ASCII 1 à 32
        $slotStart = trim(filter_input(INPUT_POST, 'slotStart', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($slotStart)) { //Si $slotStart est vide
            $error['slotStart'] = 'Vous n\'avez pas renseigné le "début" pour le créneau'; // Message d'erreur $slotStart vide
        } elseif (!filter_var($slotStart, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_SLOT . '/')))) { //Sinon si $slotStart ne correspond pas à un format heure:minute
            $error['slotStart'] = 'Le début du créneau ne correspond pas au format requis pour un créneau'; //Message d'erreur slotStart format
        }

        // ?slotEnd
        // Nettoyage de tout les caractères ASCII 1 à 32
        $slotEnd = trim(filter_input(INPUT_POST, 'slotEnd', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($slotEnd)) { //Si $slotEnd est vide
            $error['slotEnd'] = 'Vous n\'avez pas renseigné la "fin" pour le créneau'; // Message d'erreur $slotEnd vide
        } elseif (!filter_var($slotEnd, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_SLOT . '/')))) { //Sinon si $slotEnd ne correspond pas à un format heure:minute
            $error['slotEnd'] = 'La fin du créneau ne correspond pas au format requis pour un créneau'; //Message d'erreur slotEnd format
        }

        // ?slotStep
        // Nettoyage de tout les caractères ASCII 1 à 32
        $slotStep = intval(filter_input(INPUT_POST, 'slotStep', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($slotStep)) { //Si $slotStep est vide
            $error['slotStep'] = 'Vous n\'avez pas renseigné l\'interval pour le créneau'; // Message d'erreur $slotStep vide
        } elseif (!filter_var($slotStep, FILTER_VALIDATE_INT)) { //Sinon si $slotStep ne correspond pas à un format heure:minute
            $error['slotStep'] = 'L\'interval du créneau ne correspond pas au format requis pour un interval'; //Message d'erreur slotStep format
        }
        
        
        // ?No error -> redirect to home page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Nouvelle instance de la class Slot
            $slot = new Slot();
            // Hydratation de l'objet $slot
            $slot->setSlotStart($slotStart);
            $slot->setSlotEnd($slotEnd);
            $slot->setSlotStep($slotStep);

            // Ajouter le slot à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $slot->add();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('slotAdded', 'Une erreur est survenue lors de l\'ajout du créneau à la base de données');
            } else { //Si pas d'erreur retour à la page d'Accueil
                Flash::flash('slotAdded', 'Créneau ajouté avec succès', FLASH_SUCCESS);
                header('location: /Dashboard/Appointments/Slots/List');
                die;
            }
        }

        // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
    }
} catch (\Throwable $th) {
    include(__DIR__ . '/../../../../views/dashboard/templates/header.php');
    include(__DIR__ . '/../../../../views/templates/errors.php');
    include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');
    die;
}

// !HEADER
$linkCss = 'appointments/add';
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');

// !VIEWS
include(__DIR__ . '/../../../../views/dashboard/appointments/slots/add.php');

// !FOOTER
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');
