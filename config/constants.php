<?php

// CONSTANTES

// ?BDD
// Données de connexion à la base de données
// Nom de la base de données
define('DB_NAME', 'maurouardnails');
// Hote de la base de données
define('DB_HOST', '127.0.0.1');
define('DB_DSN', 'mysql:dbname='.DB_NAME.';host='.DB_HOST);
// Nom de l'utilisateur ayant les droits administrateur sur la base de données
define('DB_USER', 'ouioui');
// Mot de passe de cet utilisateur
define('DB_PASSWORD', 'ouiOUI123&');

// ?REGEX
// Lastname
define('REGEXP_LASTNAME',       '^([a-zA-ZàáâäãåčćèéêëėìíîïńòóôöõøùúûüūÿýżźñçčšžÀÁÂÄÃÅĆČĖÈÉÊËÌÍÎÏŃÒÓÔÖÕØÙÚÛÜŪŸÝŻŹÑÇŒÆČŠŽ\' \-]{1,24})$');
// Firstname
define('REGEXP_FIRSTNAME',      '^([a-zA-ZàáâäãåčćèéêëėìíîïńòóôöõøùúûüūÿýżźñçčšžÀÁÂÄÃÅĆČĖÈÉÊËÌÍÎÏŃÒÓÔÖÕØÙÚÛÜŪŸÝŻŹÑÇŒÆČŠŽ\' \-]{1,24})$');
// Password
define('REGEXP_PASSWORD',       '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{6,15}$');
// Phone number
define('REGEXP_PHONE_NUMBER',   '^(0[1-9]{1})(\d{8})$');
// Birthday
define('REGEXP_BIRTHDATE',      '^((19\d{2}|20[01]\d|202[1-3])\-(0[1-9]|1[0-2])\-(0[1-9]|[12][0-9]|3[01]))$');

// ?OTHERS
// Définir le fuseau horaire sur Paris
date_default_timezone_set('Europe/Paris');

// Formattage de date YY-mm-dd en dd MMMM YYYY
$dayMonthYearFormatStringFr = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    'dd MMMM yyyy'
);
define('DATE_FORMAT', $dayMonthYearFormatStringFr);


// ?SESSION FLASH
define('FLASH', 'FLASH_MESSAGES');
define('FLASH_DANGER', 'danger');
define('FLASH_WARNING', 'warning');
define('FLASH_INFO', 'info');
define('FLASH_SUCCESS', 'success');
