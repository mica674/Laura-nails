<?php

require_once(__DIR__ . '/../models/Database.php');

class Client
{

    private int $id;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $password;
    private string $phone;
    private string $birthdate;

    // METHODES
    // ?MAGIQUES
    // construct
    public function __construct()
    {
        
    }

}