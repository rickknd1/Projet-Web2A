<?php 

class Offres_stage
{
    private ?int $id = null;
    private ?string $titre;
    private ?string $entreprise;
    private ?string $type_stage;
    private ?string $duree;
    private ?string $domaine;
    private ?int $nombre_place;
    private ?string $description;

    public function __construct(?int $id=null, ?string $titre, ?string $entreprise, ?string $type_stage, ?string $duree, ?string $domaine, ?int $nombre_place, ?string $description)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->entreprise = $entreprise;
        $this->type_stage = $type_stage;
        $this->duree = $duree;
        $this->domaine = $domaine;
        $this->nombre_place = $nombre_place;
        $this->description = $description;
    }

    public function getIdOF(): ?int
    {
        return $this->id;
    }

    public function getTitreOF(): ?string
    {
        return $this->titre;
    }

    public function getEntrepriseOF(): ?string
    {
        return $this->entreprise;
    }

    public function getTypestageOF(): ?string
    {
        return $this->type_stage;
    }

    public function getdureeOF(): ?string
    {
        return $this->duree;
    }

    public function getDomaineOF(): ?string
    {
        return $this->domaine;
    }

    public function getNombrePlaceOF(): ?int
    {
        return $this->nombre_place;
    }

    public function getDescriptionOF(): ?string
    {
        return $this->description;
    }

    public function setIdOF(?int $id): void
    {
        $this->id = $id;
    }

    public function setTitreOF(?string $titre): void
    {
        $this->titre = $titre;
    }

    public function setEntrepriseOF(?string $entreprise): void
    {
        $this->entreprise = $entreprise;
    }

    public function setTypestageOF(?string $type_stage): void
    {
        $this->type_stage = $type_stage;
    }

    public function setdureeOF(?string $duree): void
    {
        $this->duree = $duree;
    }

    public function setDomaineOF(?string $domaine): void
    {
        $this->domaine = $domaine;
    }

    public function setNombrePlaceOF(?int $nombre_place): void
    {
        $this->nombre_place = $nombre_place;
    }

    public function setDescriptionOF(?string $description): void
    {
        $this->description = $description;
    }
}   
?>
