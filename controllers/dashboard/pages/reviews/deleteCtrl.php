<?php
// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Comment.php');

$idComment = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
$idClient = intval(filter_input(INPUT_GET, 'idClient', FILTER_SANITIZE_NUMBER_INT));

if (!Comment::isIdExist($idComment)) {
    Flash::flash('commentDeleted', 'Le commentaire que vous essayez de supprimer n\'existe pas', FLASH_WARNING);
}else {
    if(Comment::delete($idComment)){
        Flash::flash('commentDeleted', 'Le commentaire a bien été supprimé', FLASH_SUCCESS);
    }else {
        Flash::flash('commentDeleted', 'Le commentaire n\a pas été supprimé', FLASH_DANGER);
    }
}
if ($idClient == 0) {
    header('Location: /Dashboard/Reviews/List');die;
}else {
    header('Location: /Dashboard/Clients/Edit?id='.$idClient);die;
}
