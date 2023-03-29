<?php

require_once(__DIR__ . '/Database.php');

class Appointment
{
    private int $id;
    private string $appointment;
    private int $id_clients;
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

    // APPOINTMENT
    //getter
    /**
     * Cette méthode retourne la valeur de le appointment du rendez-vous
     * @return string
     */
    public function getAppointment(): string
    {
        return $this->appointment;
    }

    //setter
    /**
     * Cette méthode hydrate le appointment du rendez-vous
     * @param string $appointment
     * 
     * @return void
     */
    public function setAppointment(string $appointment): void
    {
        $this->appointment = $appointment;
    }

    // ID Clients
    //getter
    /**
     * Cette méthode retourne la valeur de le id_clients du rendez-vous
     * @return string
     */
    public function getId_clients(): string
    {
        return $this->id_clients;
    }

    //setter
    /**
     * Cette méthode hydrate le id_clients du rendez-vous
     * @param string $id_clients
     * 
     * @return void
     */
    public function setId_clients(string $id_clients): void
    {
        $this->id_clients = $id_clients;
    }


    // ? CRUD FUNCTIONS
    // !ADD - Ajouter un rendez-vous à la base de données
    /**
     * Cette fonction permet d'ajouter un rendez-vous à la base données.
     * Elle attend aucun paramètre en entrées et retourne un booleen true si tout s'est bien passé, sinon false
     * 
     * 
     * @return bool
     */
    public function add(): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'INSERT INTO `appointments` (`appointment`, `id_clients`) 
                VALUES (:appointment, :id_clients)
                ;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':appointment',    $this->appointment);
        $sth->bindValue(':id_clients',   $this->id_clients);

        // Exécuter la requête
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !READ - Lire les informations d'un ou plusieurs rendez-vous de la base de données
    // *GET _ Récupère toutes les informations d'un rendez-vous si le paramètre $id est renseigné
    // sinon tous les rendez-vous
    /**
     * Cette fonction permet de récupérer toutes les informations d'un rendez-vous si $id est renseigné
     * OU toutes les informations de tous les rendez-vous si AUCUN $id n'est renseigné.
     * Elle attend un paramètre en entrée (format int) FACULTATIF, qui est l'id du rendez-vous ciblé et retourne un tableau (array) avec ses informations
     * @param int|bool $idAppointment
     * 
     * @return array|bool
     */
    public static function get(int|null $idAppointment = null): array|bool
    {
        // Connexion à la base de donnée
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `appointments`.`id`, `appointment`, `lastname`, `firstname`, `email`, `phone`, `clients`.`id` AS idClients
                FROM `appointments`
                JOIN `clients`
                ON `clients`.`id` = `appointments`.`id_clients`'.
                (($idAppointment) ? ' WHERE `id` = :id': '')
                . ' ORDER BY lastname;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec bindvalue s'il y en a
        $sth = $db->prepare($sql);
        ($idAppointment) ? $sth->bindValue(':id', $idAppointment, PDO::PARAM_INT) : '';
        // Exécuter la requête
        $sth->execute();
        $results = $sth->fetchAll();
        // retourner l'objet $result contenant les informations du client
        return $results;
    }


    // !UPDATE
    /**
     * Cette fonction permet de modifier un rendez-vous dans la base données.
     * Elle attend aucun paramètre d'entrée et return un booleen true si tout s'est bien passé
     * 
     * 
     * @return bool
     */
    public function update(): bool
    {
        // Connexion à la base de donnée
        $db = Database::connect();
        $sql = 'UPDATE `appointments`
                SET `appointment` = :appointment,
                    `id_clients` = :id_clients
                WHERE `id` = :id
                ;';

        $sth = $db->prepare($sql);
        $sth->bindValue(':appointment',    $this->appointment,    PDO::PARAM_STR);
        $sth->bindValue(':id_clients',   $this->id_clients,   PDO::PARAM_STR);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !DELETE
    /**
     * Cette fonction permet de supprimer un rendez-vous dans la base données.
     * Elle attend un paramètre d'entrée id du rdv à supprimer (format int)
     * et retourne un bool si la suppression a bien été effectué ou non
     * 
     * @return bool
     */
    public static function delete($idAppointment): bool
    {
        // Connexion à la base de donnée
        $db = Database::connect();
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

    // IS NOT EXIST
    public static function isExist($appointment): bool
    {
        // Connexion à la base de donnée
        $db = Database::connect();
        
        $sql = "SELECT `appointment`, `id_clients`
                FROM `appointments`
                WHERE   `appointment`  =   '$appointment'
                    ;";
        $sth = $db->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        return !empty($result);
    }

    // IS ID EXIST
    public static function isIdExist($idAppointment): bool
    {
        // Connexion à la base de donnée
        $db = Database::connect();
        $sql = "SELECT `appointment`, `id_clients`
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
        // Connexion à la base de donnée
        $db = Database::connect();
        $sql = "SELECT `id_clients`
                FROM `appointments`
                WHERE   `id_clients`  =   :idPatient
                ;";
        $sth = $db->prepare($sql);
        $sth->bindValue(':idPatient', $idPatient, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }
}
