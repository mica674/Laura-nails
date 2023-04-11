<?php

require_once(__DIR__ . '/../models/Database.php');

class Comment
{
    private int $id;
    private string $title;
    private string $content;
    private string $quotations;
    private string $created_at;
    private string $updated_at;
    private string $deleted_at;
    private string $moderated_at;
    // foreign keys
    private string $id_services;
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


    // ---------- QUOTATIONS ----------
    // getter
    /**
     * Cette méthode retourne la valeur de quotation du commentaire
     * @return int
     */

    public function getQuotations(): int
    {
        return $this->quotations;
    }

    // setter
    /**
     * Cette méthode hydrate quotation
     * @param int $quotations
     * 
     * @return void
     */
    public function setQuotations(int $quotations): void
    {
        $this->quotations = $quotations;
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


    // ---------- ID SERVICES _ FOREIGN KEY ----------
    // getter
    /**
     * Cette méthode retourne la valeur de l'ID de la prestation (service) associée au commentaire
     * @return int
     */

    public function getId_services(): int
    {
        return $this->id_services;
    }

    // setter
    /**
     * Cette méthode hydrate l'ID de la prestation (service) associée au commentaire
     * @param int $id_services
     * 
     * @return void
     */
    public function setId_services(int $id_services): void
    {
        $this->id_services = $id_services;
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
    // !ADD - Ajouter un commentaire à la base de données
    /**
     * Cette fonction permet d'ajouter un commentaire à la base données.
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
        $sql = 'INSERT INTO `comments` (`title`, `content`, `quotations`, `id_clients`) 
                VALUES (:title, :content, :quotations, :id_clients);';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':title',       $this->title,       PDO::PARAM_STR);
        $sth->bindValue(':content',     $this->content,     PDO::PARAM_STR);
        $sth->bindValue(':quotations',  $this->quotations,  PDO::PARAM_INT);
        $sth->bindValue(':id_clients',    $this->id_clients,    PDO::PARAM_INT);

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
        $sql = 'SELECT `id`, `title`, `content`, `quotations`, `id_clients`, `created_at`, `moderated_at`, `deleted_at`
                FROM `comments` 
                WHERE `deleted_at` IS NULL ' .
            (($id) ? ' AND `id` = :id' : '')
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

    // *GET _ Récupère toutes les informations de tous les commentaires d'un client si le paramètre $idClient est renseigné
    /**
     * Cette fonction permet de récupérer toutes les informations des commentaires d'un client si $idClient est renseigné
     * Elle attend un paramètre en entrée (format int) FACULTATIF, qui est l'idClient du commentaire ciblé et retourne un tableau (array) avec ses informations
     * 
     * @param string $method (moderated par défaut)
     * @param int|null $idClient
     * 
     * @return array|bool
     */
    public static function getAll(string $method = 'moderated', int|null $idClient = null): array|bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `id`, `title`, `content`, `quotations`, `id_clients`, `created_at`, `moderated_at`, `deleted_at`
                FROM `comments` ' .
            (($idClient) ? ' WHERE `id_clients` = :idClient' : '')
            . (($method == 'moderated') ? ' ORDER BY `moderated_at`, `created_at` DESC ' : ' ORDER BY `created_at` DESC, `moderated_at` ') .
            ';';
        // Preparer la requête SQl (prepare) et affecter des valeurs avec bindvalue
        $sth = $db->prepare($sql);
        (($idClient) ? ($sth->bindValue(':idClient', $idClient, PDO::PARAM_INT)) : '');
        // Exécuter la requête
        $sth->execute();
        $result = $sth->fetchAll();
        // retourner l'objet $result contenant les informations du client
        return $result;
    }

    // !UPDATE - Modifier un avis dans la base de données
    /**
     * Cette fonction permet de modifier un avis dans la base données.
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
        $sql =  'UPDATE `comments`
                SET `title` =   :title,
                    `content`     =   :content,
                    `quotations` =   :quotations
                WHERE `id`      =   :id
                ;';

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_INT);
        $sth->bindValue(':title',       $this->title,       PDO::PARAM_STR);
        $sth->bindValue(':content',     $this->content,     PDO::PARAM_STR);
        $sth->bindValue(':quotations',  $this->quotations,  PDO::PARAM_INT);

        // Executer la requête et retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return $sth->execute();
    }

    /**
     * Cette fonction permet de valider un commentaire
     * Elle attend un paramètre d'entrée (format int), l'id du commentaire à valider, et retourne un booleen true si tout c'est bien passé sinon false
     * @param int $idComment
     * 
     * @return bool
     */
    public static function validate(int $idComment): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = "UPDATE `comments`
                SET `moderated_at` = Now(),
                    `deleted_at` = NULL
                WHERE   `id`  =   :idComment
                ;";

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':idComment', $idComment, PDO::PARAM_INT);

        // Executer la requête et retourner l'état de l'opération
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }

    // !DELETE - Supprimer un commentaire (ajouter un timestamp à deleted_at)
    /**
     * Cette fonction permet de supprimer un commentaire (le rend invisible en dehors du dashboard).
     * Elle attend un paramètre d'entrée l'id du commentaire à supprimer (format int)
     * 
     * @param mixed $idClient
     * 
     * @return bool
     */
    public static function delete(int $idComment): bool
    {
        $db = Database::connect();
        $sql = 'UPDATE `comments`
                SET `deleted_at` = Now()
                WHERE `id` = :idComment;
                ;';

        $sth = $db->prepare($sql);
        $sth->bindValue(':idComment', $idComment, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }


    // ?OTHERS FUNCTIONS
    // 
    /**
     * Cette fonction permet de contrôler si un id du commentaire existe
     * Elle attend un paramètre d'entrée (format int), l'id a tester, et retourne un booleen true si l'id existe sinon false
     * @param int $idComment
     * 
     * @return bool
     */
    public static function isIdExist(int $idComment): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = "SELECT `id`
            FROM `comments`
            WHERE   `id`  =   :idComment
            ;";

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':idComment', $idComment, PDO::PARAM_INT);

        // Executer la requête et retourner l'état de l'opération (true si un id existe, sinon false)
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }

    public static function getback(int $idComment): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = "UPDATE `comments`
                    SET `deleted_at` = NULL
                    WHERE   `id`  =   :idComment
                    ;";

        // Preparer la requête SQl (prepare) et affectater des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':idComment', $idComment, PDO::PARAM_INT);

        // Executer la requête et retourner l'état de l'opération (true si un id existe, sinon false)
        $sth->execute();
        $result = $sth->rowCount();
        return !empty($result);
    }
}
