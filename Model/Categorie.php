<?php
class Categorie
{
    private ?int $idCategorie = null;
    private ?string $nomCategorie = null;
    private ?string $niveau = null;
    private ?string $imagePath = null;

    public function __construct(?int $idCategorie = null, string $nomCategorie, string $niveau, ?string $imagePath = null)
    {
        if (empty($nomCategorie)) {
            throw new InvalidArgumentException("Le nom de la catégorie ne peut pas être vide.");
        }

        $this->idCategorie = $idCategorie;
        $this->nomCategorie = $nomCategorie;
        $this->niveau = $niveau;
        $this->imagePath = $imagePath;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): void
    {
        $this->nomCategorie = $nomCategorie;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): void
    {
        $this->niveau = $niveau;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }
}
