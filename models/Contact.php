<?php

require_once(__DIR__ . '/../models/Database.php');

class Contact
{
    private int $id;
    private string $firstname;
    private string $email;
    private string $title;
    private string $content;
    private string $created_at;
    private string $updated_at;
    private string $deleted_at;
    private string $moderated_at;
    // foreign keys
    private string $id_clients;

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
     * Cette méthode retourne la valeur de l'ID du commentaire
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID du commentaire
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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

    // ---------- TITLE ----------
    // getter
    /**
     * Cette méthode retourne la valeur du titre du commentaire
     * @return string
     */

    public function getTitle(): string
    {
        return $this->title;
    }

    // setter
    /**
     * Cette méthode hydrate le titre du commentaire
     * @param string $title
     * 
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    // ---------- CONTENT ----------
    // getter
    /**
     * Cette méthode retourne la valeur du contenu du message du commentaire
     * @return string
     */

    public function getContent(): string
    {
        return $this->content;
    }

    // setter
    /**
     * Cette méthode hydrate le contenu du message du commentaire
     * @param string $content
     * 
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    // ---------- MODERATED AT ----------
    // getter
    /**
     * Cette méthode retourne la valeur de la date de la modération du commentaire
     * @return string
     */

    public function getModerated_at(): string
    {
        return $this->moderated_at;
    }

    // setter
    /**
     * Cette méthode hydrate la date de la modération du commentaire
     * @param string $id
     * 
     * @return void
     */
    public function setModerated_at(string $moderated_at): void
    {
        $this->moderated_at = $moderated_at;
    }


    // ---------- ID USERS _ FOREIGN KEY ----------
    // getter
    /**
     * Cette méthode retourne la valeur de l'ID de l'utilisateur associé au commentaire
     * @return int
     */

    public function getId_clients(): int
    {
        return $this->id_clients;
    }

    // setter
    /**
     * Cette méthode hydrate l'ID de l'utilisateur associé au commentaire
     * @param int $id_clients
     * 
     * @return void
     */
    public function setId_clients(int $id_clients): void
    {
        $this->id_clients = $id_clients;
    }


    // ? CRUD FUNCTIONS
    // !ADD - Ajouter un contact à la base de données
    /**
     * Cette fonction permet d'ajouter un contact à la base données.
     * Elle attend aucun paramètre en entrée et return un booleen true si tout s'est bien passé
     * 
     * 
     * @return bool
     */
    public function add(): bool
    {
        // Connexion à la base de données
        $db = Database::connect();
        // Requête SQL
        $sql = 'INSERT INTO `contacts` (`firstname`, `email`, `title`, `content`, `id_clients`) 
                VALUES (:firstname, :email, :title, :content, :id_clients);';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':firstname',   $this->firstname,   PDO::PARAM_STR);
        $sth->bindValue(':email',       $this->email,       PDO::PARAM_STR);
        $sth->bindValue(':title',       $this->title,       PDO::PARAM_STR);
        $sth->bindValue(':content',     $this->content,     PDO::PARAM_STR);
        $sth->bindValue(':id_clients',  $this->id_clients,  PDO::PARAM_INT);

        // Exécuter la requête 
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();

        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !READ - Lire les informations d'un ou plusieurs commentaire(s) de la base de données
    // *GET _ Récupère toutes les informations d'un commentaire si le paramètre $id est renseigné
    // sinon tous les commentaires
    /**
     * Cette fonction permet de récupérer toutes les informations d'un commentaire si $id est renseigné
     * OU toutes les informations de tous les commentaires si AUCUN $id n'est renseigné.
     * Elle attend un paramètre en entrée (format int) FACULTATIF, qui est l'id du commentaire ciblé et retourne un tableau (array) avec ses informations
     * 
     * @param int|null $id
     * 
     * @return array|object|bool
     */
    public static function get(int|null $id = null): array|object|bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `id`, `title`, `content`, `quotations`, `id_clients`, `created_at`
                FROM `comments`' .
            (($id) ? 'WHERE `id` = :id' : '')
            . ' ORDER BY `created_at` DESC
            LIMIT 5;';
        // Preparer la requête SQl (prepare) et affecter des valeurs avec bindvalue
        $sth = $db->prepare($sql);
        (($id) ? ($sth->bindValue(':id', $id, PDO::PARAM_INT)) : '');
        // Exécuter la requête
        $sth->execute();
        $result = ($id) ? ($sth->fetch()) : ($sth->fetchAll());
        // retourner l'objet $result contenant les informations du client
        return $result;
    }

    // !UPDATE - Modifier un client dans la base de données
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
        $db = Database::connect();

        // Requête SQL
        $sql =  'UPDATE `clients`
                SET `lastname`  =   :lastname,
                    `firstname` =   :firstname,
                    `email`     =   :email,
                    `birthdate` =   :birthdate,
                    `phone`     =   :phone
                WHERE `id`      =   :id
                ;';

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_INT);
        $sth->bindValue(':lastname',    $this->lastname,    PDO::PARAM_STR);
        $sth->bindValue(':firstname',   $this->firstname,   PDO::PARAM_STR);
        $sth->bindValue(':email',       $this->email,       PDO::PARAM_STR);
        $sth->bindValue(':password',    $this->password,    PDO::PARAM_STR);
        $sth->bindValue(':phone',       $this->phone,       PDO::PARAM_STR);
        $sth->bindValue(':birthdate',   $this->birthdate,   PDO::PARAM_STR);

        // Executer la requête et retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return $sth->execute();
    }

    // !DELETE - Supprimer un client de la base de données
    /**
     * Cette fonction permet de supprimer un client de la base données.
     * Elle attend un paramètre d'entrée l'id du client à supprimer (format int)
     * 
     * 
     * @return bool
     */
    public static function delete($idClient): bool
    {
        $db = Database::connect();
        $sql = 'DELETE
                FROM `clients`
                WHERE `id` = :id;
                ;';

        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idClient, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }



    // ?OTHERS FUNCTIONS
    // IS CLIENT EXIST - Controler si un client existe déjà dans la base de données
    /**
     * Cette fonction permet de contrôler si un client existe déjà dans la base données.
     * Elle attend 4 paramètres en entrées (format string) et return un booleen true si un client avec ces 4 informations existe déjà
     * 
     * @param string $lastname
     * @param string $firstname
     * @param string $email
     * @param string $birthdate
     * 
     * @return bool
     */
    public static function isClientExist($lastname, $firstname, $email, $birthdate): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = "SELECT `lastname`, `firstname`, `email`, `birthdate`
                FROM `clients`
                WHERE   `lastname`  =   :lastname
                    AND `firstname` =   :firstname
                    AND `email`     =   :email
                    AND `birthdate` =   :birthdate
                ;";
        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':lastname', $lastname);
        $sth->bindValue(':firstname', $firstname);
        $sth->bindValue(':email', $email);
        $sth->bindValue(':birthdate', $birthdate);

        // Executer la requête et retourner l'état de l'opération (true si un client avec ces 4 informations existe déjà, sinon false)
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }

    /**
     * Cette fonction permet de contrôler si un id de client existe
     * Elle attend un paramètre d'entrée (format int), l'id a tester, et retourne un booleen true si l'id existe sinon false
     * @param int $id
     * 
     * @return bool
     */
    public static function isIdExist(int $id): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = "SELECT `id`
            FROM `patients`
            WHERE   `id`  =   :id
            ;";

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);

        // Executer la requête et retourner l'état de l'opération (true si un id existe, sinon false)
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }
}
