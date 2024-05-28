<?php

class Candidaturestage
{
    private ?int $candidaturestage_id = null;
    private ?int $offre_id;
    private ?int $user_id;
    private ?string $date_candidaturestage;
    private ?string $lettre_motivation;
    private ?string $cv_path;
    private ?string $statut;

    public function __construct(?int $candidaturestage_id = null, ?int $offre_id, ?int $user_id, ?string $date_candidaturestage, ?string $lettre_motivation, ?string $cv_path, ?string $statut)
    {
        $this->candidaturestage_id = $candidaturestage_id;
        $this->offre_id = $offre_id;
        $this->user_id = $user_id;
        $this->date_candidaturestage = $date_candidaturestage;
        $this->lettre_motivation = $lettre_motivation;
        $this->cv_path = $cv_path;
        $this->statut = $statut;
    }

    public function getcandidaturestageId(): ?int
    {
        return $this->candidaturestage_id;
    }

    public function getOffreId(): ?int
    {
        return $this->offre_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getDatecandidaturestage(): ?string
    {
        return $this->date_candidaturestage;
    }

    public function getLettreMotivation(): ?string
    {
        return $this->lettre_motivation;
    }

    public function getCvPath(): ?string
    {
        return $this->cv_path;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setcandidaturestageId(?int $candidaturestage_id): void
    {
        $this->candidaturestage_id = $candidaturestage_id;
    }

    public function setOffreId(?int $offre_id): void
    {
        $this->offre_id = $offre_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setDatecandidaturestage(?string $date_candidaturestage): void
    {
        $this->date_candidaturestage = $date_candidaturestage;
    }

    public function setLettreMotivation(?string $lettre_motivation): void
    {
        $this->lettre_motivation = $lettre_motivation;
    }

    public function setCvPath(?string $cv_path): void
    {
        $this->cv_path = $cv_path;
    }

    public function setStatut(?string $statut): void
    {
        $this->statut = $statut;
    }
}   
?>
