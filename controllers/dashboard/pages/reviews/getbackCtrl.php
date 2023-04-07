<?php

// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Comment.php');

$idComment = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

if (!Comment::isIdExist($idComment)) {
    Flash::flash('commentDeleted', 'L\'avis que vous essayez de récupérer n\'existe pas', FLASH_WARNING);
    header('Location: /Dashboard/Reviews/List');die;
}else {
    if(Comment::getback($idComment)){
        Flash::flash('commentDeleted', 'L\'avis a bien été récupéré', FLASH_SUCCESS);
        header('Location: /Dashboard/Reviews/List');die;
    };
}