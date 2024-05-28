<?php

include_once '../../config.php';
include '../../Model/event.php';

class EventC
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    public function listEvents()
    {
        $query_events = $this->db->query("SELECT id_event, nom_cours, date_cours FROM event");
        $eventsData = $query_events->fetchAll(PDO::FETCH_ASSOC);

        $events = [];
        foreach ($eventsData as $eventData) {
            $event = new Event($eventData['id_event'], $eventData['nom_cours'], $eventData['date_cours']);
            $events[] = $event;
        }

        return $events;
    }

    public function getEventById($id)
    {
        $query = $this->db->prepare("SELECT id_event, nom_cours, date_cours FROM event WHERE id_event = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $eventData = $query->fetch(PDO::FETCH_ASSOC);

        if ($eventData) {
            $event = new Event($eventData['id_event'], $eventData['nom_cours'], $eventData['date_cours']);
            return $event;
        } else {
            return null;
        }
    }

    public function addEvent($event)
    {
        $query = $this->db->prepare("INSERT INTO event (nom_cours, date_cours) VALUES (:nomCours, :dateCours)");
        $query->bindParam(':nomCours', $event->getNomCours(), PDO::PARAM_STR);
        $query->bindParam(':dateCours', $event->getDateCours(), PDO::PARAM_STR);
        return $query->execute();
    }

    public function updateEvent($event, $id)
    {
        $query = $this->db->prepare("UPDATE event SET nom_cours = :nomCours, date_cours = :dateCours WHERE id_event = :id");
        $query->bindParam(':nomCours', $event->getNomCours(), PDO::PARAM_STR);
        $query->bindParam(':dateCours', $event->getDateCours(), PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function deleteEvent($id)
    {
        $query = $this->db->prepare("DELETE FROM event WHERE id_event = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}

?>
