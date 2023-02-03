<?php

// CONSTANTES
// REGEX
    // Lastname
    define('REGEXP_LASTNAME', "^([A-Z]{1})([a-zA-ZÀ-ÿ' \-]+)$");
    // Firstname
    define('REGEXP_FIRSTNAME', "^([A-Z]{1})([a-zA-ZÀ-ÿ' \-]+)$");
    // Password
    define('REGEXP_PASSWORD', "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,15}$");
    // Phone number
    define('REGEXP_PHONE_NUMBER', "^(0[1-9]{1})(\d{8})$");
    // Birthday
    define('REGEXP_BIRTHDAY', "^((19\d{2}|20[01]\d|202[1-3])\-(0[1-9]|1[0-2])\-(0[1-9]|[12][0-9]|3[01]))$");

