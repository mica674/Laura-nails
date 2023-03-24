<?php

require_once(__DIR__ . '/Database.php');

class Benefit //Prestations
{
    private int $id;
    private string $title;
    private string $description;
    private int $duration; //Durée de la prestation. Uniquement en minute, même si ca dépasse une heure
    private float $price; //Prix de la prestation. FLOTTANT
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
     * Cette méthode retourne la valeur de l'ID de la PRESTATION
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID de la PRESTATION
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // TITLE
    //getter
    /**
     * Cette méthode retourne la valeur du TITLE de la PRESTATION
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    //setter
    /**
     * Cette méthode hydrate du TITLE de la PRESTATION
     * @param string $title
     * 
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    // DESCRIPTION
    //getter
    /**
     * Cette méthode retourne la valeur de la DESCRIPTION de la PRESTATION
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    //setter
    /**
     * Cette méthode hydrate la DESCRIPTION de la PRESTATION
     * @param string $description
     * 
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    // DURATION
    //getter
    /**
     * Cette méthode retourne la valeur de DURATION de la PRESTATION
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    //setter
    /**
     * Cette méthode hydrate la valeur de DURATION de la PRESTATION
     * @param int $duration
     * 
     * @return void
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    // PRICE
    //getter
    /**
     * Cette méthode retourne la valeur de PRICE de la PRESTATION
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    //setter
    /**
     * Cette méthode hydrate la valeur de PRICE de la PRESTATION
     * @param float $price
     * 
     * @return void
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    // ?CRUD
    // CREATED AT
    // getter
    /**
     * Cette méthode retourne la valeur de CREATED AT de la PRESTATION
     * 
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    // setter
    /**
     * Cette méthode hydrate la valeur de CREATED AT de la prestation
     * 
     * @param string $createdAt
     * 
     * @return void
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    // UPDATED AT
    // getter
    /**
     * 
     * Cette méthode retourne la valeur de UPDATED AT de la PRESTATION
     * 
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    // setter
    /**
     * 
     * Cette méthode hydrate la valeur de UPDATED AT de la prestation
     * 
     * @param string $updatedAt
     * 
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updated_at = $updatedAt;
    }

    // DELETED AT
    // getter
    /**
     * 
     * Cette méthode retourne la valeur de DELETED AT de la PRESTATION
     * 
     * @return string
     */
    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    // setter
    /**
     * 
     * Cette méthode hydrate la valeur de DELETED AT de la prestation
     * 
     * @param string $deletedAt
     * 
     * @return void
     */
    public function setDeletedAt(string $deletedAt): void
    {
        $this->deleted_at = $deletedAt;
    }

    // ?CRUD FUNCTIONS
    // !ADD - Ajouter une prestation à la base de données
    /**
     * Cette fonction permet d'ajouter une prestation à la base données.
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
        $sql = 'INSERT INTO `services` (`title`, `description`, `duration`, `price`) 
                VALUES (:title, :description, :duration, :price)
                ;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':title',       $this->title);
        $sth->bindValue(':description', $this->description);
        $sth->bindValue(':duration',    $this->duration, PDO::PARAM_INT);
        $sth->bindValue(':price',       $this->price, PDO::PARAM_INT);

        // Exécuter la requête
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !READ - Lire les informations d'une ou plusieurs prestation(s) de la base de données
    // *GET _ Récupère toutes les informations d'une prestation si le paramètre $id est renseigné
    // sinon toutes les prestations
    /**
     * Cette fonction permet de récupérer toutes les informations d'une prestation si $id est renseigné
     * OU toutes les informations de toutes les prestations si AUCUN $id n'est renseigné.
     * Elle attend un paramètre en entrée (format int) FACULTATIF, qui est l'id de la prestation ciblée et retourne un tableau (array) avec ses informations
     * @param int|bool $idPresta
     * 
     * @return array|bool
     */
    public static function get(int|null $idPresta = null): array|bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `id`, `title`, `description`, `duration`, `price`
                FROM `services`' . //Concaténation avec '.'
            (($idPresta) ? 'WHERE `id` = :id' : '')
            . ' ORDER BY `created_at`';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec bindvalue s'il y en a
        $sth = $db->prepare($sql);
        ($idPresta) ? $sth->bindValue(':id', $idPresta, PDO::PARAM_INT) : '';
        // Exécuter la requête
        $sth->execute();
        $results = $sth->fetchAll();
        // retourner l'objet $result contenant les informations du client
        return $results;
    }

    // !UPDATE
    /**
     * Cette fonction permet de modifier une prestation dans la base données.
     * Elle attend aucun paramètre d'entrée et return un booleen true si tout s'est bien passé
     * 
     * 
     * @return bool
     */
    public function update(): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'UPDATE `services`
                SET `title` = :title,
                    `description` = :description,
                    `duration` = :duration,
                    `price` = :price
                WHERE `id` = :id
                ;';

        // Préparer, affecter les valeurs avec bind value et executer la requête
        $sth = $db->prepare($sql);
        $sth->bindValue(':title',       $this->title,       PDO::PARAM_STR);
        $sth->bindValue(':description', $this->description, PDO::PARAM_STR);
        $sth->bindValue(':duration',    $this->duration,    PDO::PARAM_INT);
        $sth->bindValue(':price',       $this->price,       PDO::PARAM_INT);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !DELETE
    /**
     * Cette fonction permet de supprimer une prestation dans la base données.
     * Elle attend un paramètre d'entrée id de la prestation à supprimer (format int)
     * et retourne un bool si la suppression a bien été effectué ou non
     * 
     * @return bool
     */
    public static function delete($idPresta): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'DELETE
                FROM `services`
                WHERE `id` = :id;
                ;';

        // Préparer, affecter les valeurs avec bind value et executer la requête
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idPresta, PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $result = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($result);
    }


    // ?OTHERS FUNCTIONS
    // IS EXIST
    /**
     * Cette méthode vérifie si l'id de la prestation existe
     * Si l'id existe la méthode renvoie true, sinon false
     * 
     * @param int $idPresta
     * 
     * @return bool
     */
    public static function isExist(int $idPresta): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `id`
                FROM `services`
                WHERE `id` = :id;
                ;';

        // Préparer, affecter les valeurs avec bind value et executer la requête
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idPresta, PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $result = $sth->fetch();
        // Retourner l'état de l'opération (true si une prestation correspond à la requête SQL, sinon false)
        return !empty($result);
    }
}
