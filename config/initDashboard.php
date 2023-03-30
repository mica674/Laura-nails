<?php
session_start();

// !FLASH
require_once(__DIR__ . '/../helpers/flash.php');

// !CONSTANTS
require_once(__DIR__ . '/../config/constants.php');

if (isset($_SESSION['client'])) {
    $clientConnected=true;
    if (!$_SESSION['client']->adminADMIN) {
        $adminConnected = false;
    }else{
        $adminConnected = true;
    }
} elseif (isset($_COOKIE['client'])) {
    $clientConnected=true;
    if (!unserialize($_COOKIE['client'])->adminADMIN) {
        $adminConnected = false;
    }else{
        $adminConnected =true;
    }
} else {
    $clientConnected=false;
    $adminConnected = false;
}

if (!$adminConnected) {
    Flash::flash('getOut', 'Vous n\'avez pas l\'autorisation pour accéder à cette espace, dégagez ou j\'appelle la police...', FLASH_DANGER);
    header('Location: /Accueil');
    die;
}
