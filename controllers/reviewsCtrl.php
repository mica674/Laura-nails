<?php

// !INIT
require_once(__DIR__ . '/../config/init.php');

// !MODELS
require_once(__DIR__ . '/../models/Comment.php');
require_once(__DIR__ . '/../models/Client.php');

try {
    if (!$clientConnected) {
        Flash::flash('forbiddenAccess', 'Veuillez vous connecter pour pouvoir poster un commentaire', FLASH_WARNING);
        header('Location: /Connexion');die;
    }
    // Récupérer les 5 derniers commentaires postés
    $last5Comments = Comment::get();

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST

        // ?FIRSTNAME
        // Nettoyage de tout les caractères ASCII 1 à 32
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($firstname)) { //Si $firstname est vide
            $error['firstname'] = 'Vous n\'avez pas renseigné votre "Prénom"'; // Message d'erreur firstname vide
        } elseif (!(filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_FIRSTNAME . '/'))))) { //Sinon si $firstname ne correspond pas à un format de prénom
            $error["firstname"] = 'Le prénom ne correspond pas au format requis pour un prénom'; //Message d'erreur firstname format
        }
        if (empty($error['firstname'])){
            $firstname = ucfirst(strtolower($firstname));
        }

        // ?REVIEW's TITLE
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
        
        // ?REVIEW's MESSAGE
        // Nettoyage de tout les caractères ASCII 1 à 32
        $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));

        // Validation des données
        if (empty($message)) { //Si $message est vide
            $error['message'] = 'Vous n\'avez pas renseigné le "Message" de l\'avis'; // Message d'erreur message vide
        } elseif (!(filter_var($message, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEXP_MESSAGE . '/'))))) { //Sinon si $message ne correspond pas à un format message
            $error["message"] = 'Le message ne correspond pas au format requis pour un message'; //Message d'erreur message format
        }

        // ?REVIEW's STARS
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $quotations = intval(filter_input(INPUT_POST, 'star', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($quotations)) {
            $error['quotations'] = 'Le nombre d\'étoile n\'est pas renseigné ! ';
        }

        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            $id_clients = ($methodToConnect == 'session')?$_SESSION['client']->id:unserialize($_COOKIE['client'])->id;

            // Nouvelle instance de la class Comment
            $review = new Comment();
            // Hydratation de l'objet $review
            $review->setTitle($title);
            $review->setContent($message);
            $review->setQuotations($quotations);
            $review->setId_clients($id_clients);

            // Ajouter le commentaire à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $review->add();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('commentAdded', 'Une erreur est survenue lors de l\'ajout du commentaire à la base de données');
            } else { //Si pas d'erreur retour à la page des avis
                Flash::flash('commentAdded', 'Commentaire ajouté avec succès', FLASH_SUCCESS);
                header('location: /Avis');
                die;
            }
        }

        // End if ($_SERVER['REQUEST_METHOD'] == 'POST')
    }

    
} catch (\Throwable $th) {
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/templates/errors.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}



// !HEADER
$linkCss = 'reviews';
include_once(__DIR__ . '/../views/templates/header.php');

// !VIEWS
include_once(__DIR__ . '/../views/reviews.php');


// !FOOTER
$jsToCall = 'scriptReviews';
include_once(__DIR__ . '/../views/templates/footer.php');
