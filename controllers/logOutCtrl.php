<?php
// !INIT
require_once(__DIR__ . '/../config/init.php');

setcookie('client', '', time()-3600);
unset($_SESSION['client']);
session_destroy();

header('Location: /Accueil');die;

