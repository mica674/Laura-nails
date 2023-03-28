<?php

require_once(__DIR__ . '/Database.php');

class Slot
{
    private int $id;
    private string $slotStart;
    private string $slotEnd;
    private string $slotStep;
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
     * Cette méthode retourne la valeur de l'ID de l'interval
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID de l'interval
     * @param int $id
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // SLOT START
    //getter
    /**
     * Cette méthode retourne la valeur du SLOT START de l'interval
     * @return string
     */
    public function getSlotStart(): string
    {
        return $this->slotStart;
    }

    //setter
    /**
     * Cette méthode hydrate du SLOT START de l'interval
     * @param string $slotStart
     * 
     * @return void
     */
    public function setSlotStart(string $slotStart): void
    {
        $this->slotStart = $slotStart;
    }

    // SLOT END
    //getter
    /**
     * Cette méthode retourne la valeur de la SLOT END de l'interval
     * @return string
     */
    public function getSlotEnd(): string
    {
        return $this->slotEnd;
    }

    //setter
    /**
     * Cette méthode hydrate la SLOT END de l'interval
     * @param string $slotEnd
     * 
     * @return void
     */
    public function setSlotEnd(string $slotEnd): void
    {
        $this->slotEnd = $slotEnd;
    }

    // SLOT STEP
    //getter
    /**
     * Cette méthode retourne la valeur de SLOT STEP de l'interval
     * @return int
     */
    public function getSlotStep(): int
    {
        return $this->slotStep;
    }

    //setter
    /**
     * Cette méthode hydrate la valeur de SLOT STEP de l'interval
     * @param int $slotStep
     * 
     * @return void
     */
    public function setSlotStep(int $slotStep): void
    {
        $this->slotStep = $slotStep;
    }


    // ?CRUD
    // CREATED AT
    // getter
    /**
     * Cette méthode retourne la valeur de CREATED AT de l'interval
     * 
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    // setter
    /**
     * Cette méthode hydrate la valeur de CREATED AT de l'interval
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
     * Cette méthode retourne la valeur de UPDATED AT de l'interval
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
     * Cette méthode hydrate la valeur de UPDATED AT de l'interval
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
     * Cette méthode retourne la valeur de DELETED AT de l'interval
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
     * Cette méthode hydrate la valeur de DELETED AT de l'interval
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
    // !ADD - Ajouter un créneau horaire à la base de données
    /**
     * Cette fonction permet d'ajouter un créneau horaire à la base données.
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
        $sql = 'INSERT INTO `slots` (`slotStart`, `slotEnd`, `slotStep`) 
                VALUES (:slotStart, :slotEnd, :slotStep)
                ;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':slotStart',   $this->slotStart);
        $sth->bindValue(':slotEnd',     $this->slotEnd);
        $sth->bindValue(':slotStep',    $this->slotStep, PDO::PARAM_INT);

        // Exécuter la requête
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !READ - Lire les informations d'un ou plusieurs créneau(x) de la base de données
    // *GET _ Récupère toutes les informations d'un créneau si le paramètre $id est renseigné
    // sinon tous les créneaux
    /**
     * Cette fonction permet de récupérer toutes les informations d'un créneau si $id est renseigné
     * OU toutes les informations de tous les créneaux si AUCUN $id n'est renseigné.
     * Elle attend un paramètre en entrée (format int) FACULTATIF, qui est l'id du créneau ciblé et retourne un tableau (array) avec ses informations
     * @param int|bool $idSlot
     * 
     * @return object|array|bool
     */
    public static function get(int|null $idSlot = null): object|array|bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `id`, `slotStart`, `slotEnd`, `slotStep`
                FROM `slots`' . //Concaténation avec '.'
            (($idSlot) ? 'WHERE `id` = :id' : '')
            . ' ORDER BY `slotStart`';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec bindvalue s'il y en a
        $sth = $db->prepare($sql);
        ($idSlot) ? $sth->bindValue(':id', $idSlot, PDO::PARAM_INT) : '';
        // Exécuter la requête
        $sth->execute();
        ($results = ($idSlot)? $sth->fetch() : $sth->fetchAll());
        // retourner l'objet $result contenant les informations du client
        return $results;
    }

    // !UPDATE
    /**
     * Cette fonction permet de modifier un créneau dans la base données.
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
        $sql = 'UPDATE `slots`
                SET `slotStart` = :slotStart,
                    `slotEnd` = :slotEnd,
                    `slotStep` = :slotStep,
                WHERE `id` = :id
                ;';

        // Préparer, affecter les valeurs avec bind value et executer la requête
        $sth = $db->prepare($sql);
        $sth->bindValue(':slotStart',   $this->slotStart,   PDO::PARAM_STR);
        $sth->bindValue(':slotEnd',     $this->slotEnd,     PDO::PARAM_STR);
        $sth->bindValue(':slotStep',    $this->slotStep,   PDO::PARAM_INT);
        $sth->bindValue(':id',          $this->id,          PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }

    // !DELETE
    /**
     * Cette fonction permet de supprimer un créneau dans la base données.
     * Elle attend un paramètre d'entrée id du créneau à supprimer (format int)
     * et retourne un bool si la suppression a bien été effectué ou non
     * 
     * @return bool
     */
    public static function delete($idSlot): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'DELETE
                FROM `slots`
                WHERE `id` = :id;
                ;';

        // Préparer, affecter les valeurs avec bind value et executer la requête
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idSlot, PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $result = $sth->rowCount();
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($result);
    }


    // ?OTHERS FUNCTIONS
    // IS EXIST
    /**
     * Cette méthode vérifie si l'id du créneau existe
     * Si l'id existe la méthode renvoie true, sinon false
     * 
     * @param int $idSlot
     * 
     * @return bool
     */
    public static function isExist(int $idSlot): bool
    {
        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'SELECT `id`
                FROM `slots`
                WHERE `id` = :id;
                ;';

        // Préparer, affecter les valeurs avec bind value et executer la requête
        $sth = $db->prepare($sql);
        $sth->bindValue(':id', $idSlot, PDO::PARAM_INT);
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $result = $sth->fetch();
        // Retourner l'état de l'opération (true si une prestation correspond à la requête SQL, sinon false)
        return !empty($result);
    }
}
