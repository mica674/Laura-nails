<?php
// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Comment.php');

$validate = intval(filter_input(INPUT_GET, 'validate', FILTER_SANITIZE_NUMBER_INT));
$idComment = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$idClient = intval(filter_input(INPUT_GET, 'idClient', FILTER_SANITIZE_NUMBER_INT));

if (Comment::isIdExist($idComment)) {
    // Si validate == 1 -> valider le commentaire en mettant le timestamp actuel dans moderated_at
    if ($validate == 1) {
        
        $isValidate = Comment::validate($idComment);
        
        if ($isValidate) {
            // Message flash
            Flash::flash('commentValidated', 'Le commentaire a bien été validé !', FLASH_SUCCESS);
        } else {
            // Message flash
            Flash::flash('commentValidated', 'Le commentaire n\'a pas été validé !', FLASH_DANGER);
        }
    }else {//Sinon redirection pour faire la suppression
        header('Location: /Dashboard/Reviews/Delete?id='.$idComment. '&idClient='. $idClient);die;
    }

    // Redirection vers la page de la liste des clients du dashboard
    header('Location: /Dashboard/Clients/Edit?id=' . $idClient);
    die;
} else {
    Flash::flash('wrongId', 'Le commentaire sélectionné ne correspond à aucun commentaire connu', FLASH_WARNING);
    header('Location: /Dashboard/Clients/Edit?id=' . $idClient);
    die;
}
