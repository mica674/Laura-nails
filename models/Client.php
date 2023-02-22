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

    public function __toString()
    {
    }

    // ?GETTER SETTER
    // ----------  ID  ----------
    //getter
    /**
     * Cette méthode retourne la valeur de l'ID du client
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID du client
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    // ----------  LASTNAME  ----------
    //getter
    /**
     * Cette méthode retourne la valeur de LASTNAME du client
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    //setter
    /**
     * Cette méthode hydrate LASTNAME du client
     * @param string $lastname
     * 
     * @return void
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }


    // ----------  FIRSTNAME  ----------
    //getter
    /**
     * Cette méthode retourne la valeur de FIRSTNAME du client
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    //setter
    /**
     * Cette méthode hydrate FIRSTNAME du client
     * @param string $firstname
     * 
     * @return void
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }


    // ----------  EMAIL  ----------
    //getter
    /**
     * Cette méthode retourne la valeur de EMAIL du client
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    //setter
    /**
     * Cette méthode hydrate EMAIL du client
     * @param string $email
     * 
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    // ----------  PASSWORD  ----------
    //getter
    /**
     * Cette méthode retourne la valeur de PASSWORD du client
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    //setter
    /**
     * Cette méthode hydrate PASSWORD du client
     * @param string $password
     * 
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    // ----------  PHONE  ----------
    //getter
    /**
     * Cette méthode retourne la valeur de EMAIL du client
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    //setter
    /**
     * Cette méthode hydrate EMAIL du client
     * @param string $phone
     * 
     * @return void
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }


    // ----------  BIRTHDATE  ----------
    //getter
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    //setter
    public function setBirthdate(string $birthdate): void
    {
        $this->birthdate = $birthdate;
    }


    // ? CRUD FUNCTIONS
    // ADD - Ajouter un client à la base de données
    /**
     * Cette fonction permet d'ajouter un client à la base données.
     * Elle attend aucun paramètre en entrée et return un booleen true si tout s'est bien passé
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
        $sql = 'INSERT INTO `clients` (`lastname`, `firstname`, `mail`, `password`, `phone`, `birthdate`) 
                VALUES (:lastname, :firstname, :email, :password, :phone, :birthdate);';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':lastname',    $this->lastname,    PDO::PARAM_STR);
        $sth->bindValue(':firstname',   $this->firstname,   PDO::PARAM_STR);
        $sth->bindValue(':email',       $this->email,       PDO::PARAM_STR);
        $sth->bindValue(':password',    $this->password,    PDO::PARAM_STR);
        $sth->bindValue(':phone',       $this->phone,       PDO::PARAM_STR);
        $sth->bindValue(':birthdate',   $this->birthdate,   PDO::PARAM_STR);

        // Executer la requête et retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return $sth->execute();
    }

    // READ - Lire les informations d'un ou plusieurs client(s) de la base de données
    // GETONE _ Récupère toutes les informations d'un client défini par son id
    /**
     * Cette fonction permet de récupérer toutes les informations d'un client de la base données.
     * Elle attend un paramètre en entrée (format int), qui est l'id du client ciblé et retourne un tableau (array) avec ses informations
     * 
     * 
     * @return array
     */
    public static function getOne($id): array
    {
        // Connexion à la base de données
        if (!isset($db)) {
            $db = dbConnect();
        }

        // Requête SQL
        $sql = 'SELECT `id`, `lastname`, `firstname`, `mail` AS `email`, `phone`, `birthdate`
                FROM `patients` 
                WHERE `id` = ' . $id . ';';

        // Preparer la requête SQl (prepare) et affectater des valeurs sur l'objet en cours
        $sth = $db->prepare($sql);
        // Executer la requête
        $sth->execute();
        $result = $sth->fetch();
        // retourner le tableau $result contenant les informations du client
        return $result;
    }

    // GETALL _ Récupère toutes les informations de tous les clients de la base de données
    /**
     * Cette fonction permet de récupérer toutes les informations de tous les clients de la base de données.
     * Elle attend aucun paramètre en entrée et retourne un tableau (array) avec les informations de tous les clients
     * 
     * @return array
     */
    public static function getAll(): array
    {
        // Connexion à la base de données
        if (!isset($db)) {
            $db = dbConnect();
        }

        // Requête SQL
        $sql = 'SELECT `id`, `lastname`, `firstname`, `mail` AS `email`, `phone`, `birthdate`
                FROM `patients`;';

        // Preparer la requête SQl (prepare) et affectater des valeurs sur l'objet en cours
        $sth = $db->prepare($sql);
        // Executer la requête
        $sth->execute();
        $result = $sth->fetchAll();
        // retourner le tableau $result contenant les informations des clients
        return $result;
    }

    // UPDATE - Modifier un client dans la base de données
    /**
     * Cette fonction permet de modifier un client dans la base données.
     * Elle attend aucun paramètre en entrée et return un booleen true si tout s'est bien passé
     * 
     * 
     * @return bool
     */
    public function update(): bool
    {
        // Connexion à la base de données
        if (!isset($db)) {
            $db = dbConnect();
        }

        // Requête SQL
        $sql =  'UPDATE `patients`
                SET `lastname`  =   :lastname,
                    `firstname` =   :firstname,
                    `mail`      =   :email,
                    `birthdate` =   :birthdate,
                    `phone`     =   :phone
                WHERE `id`      =   :id
                ;';

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_STR);
        $sth->bindValue(':lastname',    $this->lastname,    PDO::PARAM_STR);
        $sth->bindValue(':firstname',   $this->firstname,   PDO::PARAM_STR);
        $sth->bindValue(':email',       $this->email,       PDO::PARAM_STR);
        $sth->bindValue(':password',    $this->password,    PDO::PARAM_STR);
        $sth->bindValue(':phone',       $this->phone,       PDO::PARAM_STR);
        $sth->bindValue(':birthdate',   $this->birthdate,   PDO::PARAM_STR);

        // Executer la requête et retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return $sth->execute();
    }

    // DELETE - Supprimer un ou plusieurs client dans la base de données

    //??//

    // DELETE END


    // ?OTHERS FUNCTIONS
    // IS EXIST - Controler si un client existe déjà dans la base de données
    /**
     * Cette fonction permet de contrôler si un client existe déjà dans la base données.
     * Elle attend 5 paramètres en entrées (format string) et return un booleen true si tout s'est bien passé
     * 
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param string $phone
     * @param string $birthdate
     * 
     * @return bool
     */
    public function isExist($lastname, $firstname, $email, $birthdate): bool
    {
        // Connexion à la base de données
        if (!isset($db)) {
            $db = dbConnect();
        }

        // Requête SQL
        $sql = "SELECT `lastname`, `firstname`, `mail` AS `email`, `birthdate`
                FROM `patients`
                WHERE   `lastname`  =   '$lastname'
                    AND `firstname` =   '$firstname'
                    AND `mail`     =   '$email'
                    AND `birthdate` =   '$birthdate'
                ;";
        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);

        // Executer la requête et retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        $sth->execute();
        $result = $sth->fetchAll();
        return !empty($result);


    }
}
