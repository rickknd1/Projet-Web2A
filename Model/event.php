<?php

class Event
{
    private $id_event;
    private $nom_cours;
    private $date_cours;

    public function __construct($id_event, $nom_cours, $date_cours)
    {
        $this->id_event = $id_event;
        $this->nom_cours = $nom_cours;
        $this->date_cours = $date_cours;
    }

    public function getIdEvent()
    {
        return $this->id_event;
    }

    public function getNomCours()
    {
        return $this->nom_cours;
    }

    public function getDateCours()
    {
        return $this->date_cours;
    }

    // Autres méthodes si nécessaire...
}

?>
