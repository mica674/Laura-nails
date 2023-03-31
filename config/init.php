<?php
session_start();

// !FLASH
require_once(__DIR__ . '/../helpers/flash.php');

// !CONSTANTS
require_once(__DIR__ . '/../config/constants.php');

if (isset($_SESSION['client'])) {
    $methodToConnect = 'session';
    $clientConnected = true;
    if (!$_SESSION['client']->adminADMIN) {
        $adminConnected = false;
    } else {
        $adminConnected = true;
    }
} elseif (isset($_COOKIE['client'])) {
    $methodToConnect = 'cookie';
    $clientConnected = true;
    if (!unserialize($_COOKIE['client'])->adminADMIN) {
        $adminConnected = false;
    } else {
        $adminConnected = true;
    }
} else {
    $clientConnected = false;
    $adminConnected = false;
}
