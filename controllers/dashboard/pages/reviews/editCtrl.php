<?php
// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODEL
require_once(__DIR__ . '/../../../../models/Comment.php');

$idComment = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$idClient = intval(filter_input(INPUT_GET, 'idClient', FILTER_SANITIZE_NUMBER_INT));
$comment = Comment::get($idComment);

try {
    if (empty($idComment)) {
        if ($idClient==0) {
            header('Location: /Dashboard/Reviews/List');die;
        } else {
            header('Location: /Dashboard/Clients/Edit?id='.$idClient);
            exit;   
        }
    }

    // *VERIFICATIONS DES DONNEES DU FORMULAIRE 
    // *PUIS REDIRECTION SI DONNEES VALIDEES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Si les données sont bien envoyées en POST


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

        // ?REVIEW's QUOTATIONS
        // Nettoyage des caractères autres que les chiffres & '+' & '-'
        $quotations = intval(filter_input(INPUT_POST, 'quotations', FILTER_SANITIZE_NUMBER_INT));

        // Validation des données
        if (empty($quotations)) {
            $error['quotations'] = 'Le vote n\'est pas renseigné ! ';
        }elseif ($quotations<=0 || $quotations >5) {
            $error['quotations'] = 'La valeur du vote doit être comprise en 1 et 5';
        }

        // ?Compare with previous values and new values
        if (
            $title == $comment->title
            &&  $message == $comment->content
            &&  $quotations == $comment->quotations
        ) {
            Flash::flash('commentEdited', 'Le commentaire n\'a pas été modifié', FLASH_INFO);
            header('Location: /Dashboard/Reviews/List');
            die;
        }

        if (empty($error)) { // Si aucune erreur après tous les nettoyages et les validations

            // Nouvelle instance de la class Comment
            $review = new Comment();
            // Hydratation de l'objet $review
            $review->setId($idComment);
            $review->setTitle($title);
            $review->setContent($message);
            $review->setQuotations($quotations);

            // Ajouter le commentaire à la base de donnée & affecter le résultat de l'exécution de la requête à $result
            $result = $review->update();
            if (!$result) { //Si une erreur est survenu pendant l'ajout à la base de données
                Flash::flash('commentEdited', 'Une erreur est survenue lors de la modification de l\'avis', FLASH_DANGER);
                header('Location: /Dashboard/Reviews/List');die;
            } else { //Si pas d'erreur retour à la page des avis
                Flash::flash('commentEdited', 'Avis modifié avec succès', FLASH_SUCCESS);
                header('Location: /Dashboard/Reviews/List');
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
$linkCss = 'pages/comments';
include(__DIR__ . '/../../../../views/dashboard/templates/header.php');


// !VIEW
Flash::flash();
include(__DIR__ . '/../../../../views/dashboard/pages/reviews/edit.php');


// !FOOTER
$jsToCall = 'reviews';
include(__DIR__ . '/../../../../views/dashboard/templates/footer.php');
