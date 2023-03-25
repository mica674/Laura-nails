<?php
session_start();

// !CONSTANTS
require_once(__DIR__ . '/../../../../config/constants.php');

// !FLASH
require_once(__DIR__ . '/../../../../helpers/flash.php');

// !MODEL
require_once(__DIR__ . '/../../../../models/Benefit.php');

$idPresta = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$prestation = Benefit::get($idPresta);

try {
    if (empty($idPresta)) {
        header('Location: /clientsList');
        exit;
    }

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST


        // ?NAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($name)) { //Si $name est vide
            $error['name'] = 'Vous n\'avez pas renseigné le "Nom"'; // Message d'erreur name vide
        } elseif (!filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_TITLE . '/')))) { //Sinon si $name ne correspond pas à un format name
            $error['name'] = 'Le nom ne correspond pas au format requis pour un nom'; //Message d'erreur name format
        }
        if (empty($error['name'])) {
            $name = ucfirst(strtolower($name));
        }

        // ?DESCRIPTION MAIN
        // Nettoyage de tout les caractères ASCII 1 à 32
        $descriptionMain = trim(filter_input(INPUT_POST, 'descriptionMain', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($descriptionMain)) { //Si $descriptionMain est vide
            $error['descriptionMain'] = 'Vous n\'avez pas renseigné la "Description principale"'; // Message d'erreur descriptionMain vide
        } elseif (!filter_var($descriptionMain, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_DESCRIPTION . '/')))) { //Sinon si $descriptionMain ne correspond pas à un format de description
            $error['descriptionMain'] = 'La description principale ne correspond pas au format requis pour une description'; //Message d'erreur descriptionMain format
        }
        if (empty($error['descriptionMain'])) {
            $descriptionMain = ucfirst(strtolower($descriptionMain));
        }

        // ?DESCRIPTION OPTIONAL
        // Nettoyage de tout les caractères ASCII 1 à 32
        $descriptionOptional = trim(filter_input(INPUT_POST, 'descriptionOptional', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (!empty($descriptionOptional)) {
            if (!filter_var($descriptionOptional, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_DESCRIPTION . '/')))) { //Sinon si $descriptionOptional ne correspond pas à un format de description
                $error['descriptionOptional'] = 'La description principale ne correspond pas au format requis pour une description'; //Message d'erreur descriptionOptional format
            }
            if (empty($error['descriptionOptional'])) {
                $descriptionOptional = ucfirst(strtolower($descriptionOptional));
            }
        }

        // ?DURATION
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $duration = intval(filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($duration)) {
            $error['duration'] = 'La durée n\'est pas renseignée ! ';
        } else {
            if (!filter_var($duration, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_PRICE . '/')))) { //Sinon si $duration ne correspond pas à un format de durée
                $error["duration"] = 'La durée ne correspond pas au format requis pour une durée en minutes'; //Message d'erreur durée format
            }
        }

        // ?PRICE
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $price = intval(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($price)) {
            $error['price'] = 'Le prix n\'est pas renseigné ! ';
        } else {
            if (!filter_var($price, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_PRICE . '/')))) { //Sinon si $price ne correspond pas à un format de prix
                $error["price"] = 'Le prix ne correspond pas au format requis pour un prix en euros'; //Message d'erreur durée format
            }
        }

        $description = $descriptionMain . ';' . $descriptionOptional;
        // ?Compare with previous values and new values
        if (
            $name == $prestation->title
            &&  $description == $prestation->description
            &&  $duration == $prestation->duration
            &&  $price == $prestation->price
        ) {
            Flash::flash('prestaEdited', 'La prestation n\'a pas été modifiée', FLASH_WARNING);
            header('Location: /Dashboard/Prestations/List');
            die;
        }

        // ?No error -> redirect to prestations/list page
        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations


            $prestation = new Benefit();
            $prestation->setId($idPresta);
            $prestation->setTitle($name);
            $prestation->setDescription($description);
            $prestation->setDuration($duration);
            $prestation->setPrice($price);

            // Ajouter la prestation à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $prestation->update();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('prestaEdited', 'Une erreur est survenue lors de la modification de la prestation', FLASH_DANGER);
                header('Location: /Dashboard/Prestations/List');
                die;
            } else { //Si pas d'erreur retour à la liste des prestation avec un message flash pour confirmer la modification
                Flash::flash('prestaEdited', 'La prestation a bien été modifié', FLASH_SUCCESS);
                header('Location: /Dashboard/Prestations/List');
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
$linkCss = 'pages/prestations';
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../../views/dashboard/pages/prestations/edit.php');


// !FOOTER
$jsToCall = 'prestationEdit';
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');
