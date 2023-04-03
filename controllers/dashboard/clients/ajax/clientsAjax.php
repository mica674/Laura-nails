<?php

// !INIT
require_once(__DIR__ . '/../../../../config/initDashboard.php');

// !MODELS
require_once(__DIR__ . '/../../../../models/Client.php');

// Si des infos sont passés en paramètres d'URL
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $input = trim(filter_input(INPUT_GET, 'input', FILTER_SANITIZE_SPECIAL_CHARS));
    $limit = intval(filter_input(INPUT_GET, 'nbItems', FILTER_SANITIZE_NUMBER_INT));
    $offset = (intval(filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_NUMBER_INT))-1)*$limit;

    $clientsSearch = Client::getBySearch($input, $limit, $offset);
    $nbResults = Client::getBySearch($input);
    
    if (count($clientsSearch)>0) {
        $results = [$clientsSearch, $nbResults];
        echo json_encode($results);
    }else {
    echo json_encode('false');
}


} else {
    echo json_encode("Affcher toutes les valeurs en fonction du nombre d'élements à afficher par page");
}

