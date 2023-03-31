<?php

require_once(__DIR__ . '/Database.php');

class AppointmentBenefit // For table appointments_services
{

    private int $id_appointments;
    private int $id_services;


    // METHODES
    // ?MAGIQUES
    // construct
    public function __construct($id_appointments, $id_services)
    {
        return $this->add($id_appointments, $id_services);
    }


    // ?GETTER SETTER

    // ID APPOINTMENTS
    //getter
    /**
     * Cette méthode retourne la valeur de l'ID du rendez-vous
     * @return int
     */
    public function getIdAppointments(): int
    {
        return $this->id_appointments;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID du rendez-vous
     * @param int $id_appointments
     * 
     * @return void
     */
    public function setIdAppointments(int $id_appointments): void
    {
        $this->id_appointments = $id_appointments;
    }

    // ID SERVICES
    //getter
    /**
     * Cette méthode retourne la valeur de l'ID de la prestation
     * @return int
     */
    public function getIdServices(): int
    {
        return $this->id_services;
    }

    //setter
    /**
     * Cette méthode hydrate l'ID de la prestation
     * @param int $id_services
     * 
     * @return void
     */
    public function setIdServices(int $id_services): void
    {
        $this->id_services = $id_services;
    }


    // ?CRUD FUNCTIONS
    // !ADD - Ajouter un id prestation à un id appointment dans la base de données dans la table appointments_services

    public function add($id_appointments, $id_services): bool
    {

        // Connexion à la base de données
        $db = Database::connect();

        // Requête SQL
        $sql = 'INSERT INTO `appointments_services` (`id_appointments`, `id_services`) 
                VALUES (:id_appointments, :id_services)
                ;';

        // Preparer la requête SQl (prepare) et affecter des valeurs avec les marqueurs nommés (bindValue)
        $sth = $db->prepare($sql);
        $sth->bindValue(':id_appointments', $id_appointments,   PDO::PARAM_INT);
        $sth->bindValue(':id_services',     $id_services,       PDO::PARAM_INT);

        // Exécuter la requête
        $sth->execute();

        // Compter le nombre d'enregistrements affecter par la requête
        $nbResults = $sth->rowCount();
        
        // Retourner l'état de l'opération (true si tout s'est bien passé, sinon false)
        return !empty($nbResults);
    }
}
