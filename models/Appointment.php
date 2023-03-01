<?php

require_once(__DIR__ . '/../models/Database.php');

class Appointment
{
    private int $id;
    private string $dateHour;
    private int $idClients;
    private string $created_at;
    private string $updated_at;
    private string $deleted_at;


    // METHODES
    // ?MAGIQUES
    // construct
    public function __construct()
    {
    }

    public function __toString()
    {
    }


    // ?GETTER SETTER

    // ID
    //getter
    /**
     * Cette méthode retourne la valeur de l'ID du rendez-vous
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID du rendez-vous
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // DATEHOUR
    //getter
    /**
     * Cette méthode retourne la valeur de le dateHour du rendez-vous
     * @return string
     */
    public function getDateHour(): string
    {
        return $this->dateHour;
    }

    //setter
    /**
     * Cette méthode hydrate le dateHour du rendez-vous
     * @param string $dateHour
     * 
     * @return void
     */
    public function setdateHour(string $dateHour): void
    {
        $this->dateHour = $dateHour;
    }

    // ID Clients
    //getter
    /**
     * Cette méthode retourne la valeur de le idClients du rendez-vous
     * @return string
     */
    public function getIdClients(): string
    {
        return $this->idClients;
    }

    //setter
    /**
     * Cette méthode hydrate le idClients du rendez-vous
     * @param string $idClients
     * 
     * @return void
     */
    public function setIdClients(string $idClients): void
    {
        $this->idClients = $idClients;
    }


    // ? CRUD FUNCTIONS
    // !ADD - Ajouter un rendez-vous à la base de données
    /**
     * Cette fonction permet d'ajouter un rendez-vous à la base données.
     * Elle attend aucun paramètre en entrées et retourne un booleen true si tout s'est bien passé
     * 
     * 
     * @return bool
     */
    public function add(): bool
    {
        // Connexion à la base de données
        if (!isset($db)) {
            $db = dbConnect();
        }

        // Requête SQL
        $sql = 'INSERT INTO `appointments` (`dateHour`, `idClients`) 
                VALUES (:dateHour, :idClients)
                ;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':dateHour',    $this->dateHour);
        $sth->bindValue(':idClients',   $this->idClients);

        // Exécuter la requête
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !READ - Lire les informations d'un ou plusieurs rendez-vous de la base de données
    // *GETONE - Récupère toutes les informations d'un rendez-vous spécifié par son id
    /**
     * Cette fonction permet de récupérer toutes les informations d'un rendez-vous de la base données.
     * Elle attend un paramètre en entrée (format int), qui est l'id du rendez-vous ciblé et retourne un tableau (array) avec ses informations
     * @param int $idAppt
     * 
     * @return object|bool
     */
    public static function getOne(int $idAppt): object|bool
    {
        // Connexion à la base de données
        if (!isset($db)) {
            $db = dbConnect();
        }

        // Requête SQL
        $sql = 'SELECT `id`, `dateHour`, `idClients`
                FROM `appointments`
                WHERE `id` = :id;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec bindvalue
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idAppt, PDO::PARAM_INT);
        // Exécuter la requête
        $sth->execute();
        $result = $sth->fetch();
        // retourner l'objet $result contenant les informations du client
        return $result;
    }

    // *GETALL - Récupère toutes les informations de tous les rendez-vous de la base de données
    /**
     * Cette fonction permet de retourner la liste de tous les rendez-vous des Clients avec leurs informations.
     * @return array
     */
    public static function getAll($id = false): array
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        if (!$id) {
            $sql = 'SELECT `rdv`.`id`, `dateHour`, `rdv`.`idClients` AS `idP`, `p`.`lastname`, `p`.`firstname`, `p`.`mail` AS `email`, `p`.`phone`
            FROM `appointments` AS `rdv`
            JOIN `Clients` AS `p`
            ON `rdv`.`idClients` = `p`.`id`
            ORDER BY `dateHour`, `p`.`lastname`;';
        } else {
            $sql = 'SELECT `rdv`.`id`, `dateHour`, `rdv`.`idClients` AS `idP`, `p`.`lastname`, `p`.`firstname`, `p`.`mail` AS `email`, `p`.`phone`
                    FROM `appointments` AS `rdv`
                    JOIN `Clients` AS `p`
                    ON `idClients` = `p`.`id`
                    WHERE `idClients` = ' . $id . ';';
        }
        $sth = $db->query($sql);
        $result = $sth->fetchAll();
        return $result;
    }



    // UPDATE
    /**
     * Cette fonction permet de modifier un rendez-vous dans la base données.
     * Elle attend aucun paramètre d'entrée et return un booleen true si tout s'est bien passé
     * 
     * 
     * @return bool
     */
    public function update(): bool
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        $sql = 'UPDATE `appointments`
                SET `dateHour` = :dateHour,
                    `idClients` = :idClients
                WHERE `id` = :id;
                ;';

        $sth = $db->prepare($sql);
        $sth->bindValue(':dateHour',    $this->dateHour,    PDO::PARAM_STR);
        $sth->bindValue(':idClients',  $this->idClients,  PDO::PARAM_STR);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_STR);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // DELETE
    /**
     * Cette fonction permet de supprimer un rendez-vous dans la base données.
     * Elle attend un paramètre d'entrée id du rdv à supprimer (format int)
     * 
     * 
     * @return bool
     */
    public static function delete($idAppointment): bool
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        $sql = 'DELETE
                FROM `appointments`
                WHERE `id` = :id;
                ;';

        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idAppointment, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }

    // DELETE ALL
    /**
     * Cette fonction permet de supprimer tous les rendez-vous d'un patient dans la base données.
     * Elle attend un paramètre d'entrée, l'id du patient pour supprimer ses rendez-vous (format int)
     * 
     * 
     * @return bool
     */
    public static function deleteAll($idPatient): bool
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        $sql = 'DELETE
                FROM `appointments`
                WHERE `idClients` = :idPatient;
                ;';

        $sth = $db->prepare($sql);
        $sth->bindValue(':idPatient', $idPatient, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }

    // IS NOT EXIST
    public static function isExist($dateHour): bool
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        $sql = "SELECT `dateHour`, `idClients`
                FROM `appointments`
                WHERE   `dateHour`  =   '$dateHour'
                    ;";
        $sth = $db->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        return !empty($result);
    }

    // IS ID EXIST
    public static function isIdExist($idAppointment): bool
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        $sql = "SELECT `dateHour`, `idClients`
                FROM `appointments`
                WHERE   `id`  =   :idAppointment
                ;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':idAppointment', $idAppointment, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }

    // IS APPOINTMENT EXIST
    public static function isAptExist($idPatient): bool
    {
        if (!isset($db)) {
            $db = dbConnect();
        }
        $sql = "SELECT `idClients`
                FROM `appointments`
                WHERE   `idClients`  =   :idPatient
                ;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':idPatient', $idPatient, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }
}
