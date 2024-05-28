<?php
class Contenu
{
    private ?int $id_Contenu = null;
    private ?string $titre = null;
    private ?string $description = null;
    private ?string $fichier = null;
    private ?string $video = null;
    private ?string $categorie = null;
    private ?string $imagePath = null;

    public function __construct($id_Contenu = null, $t, $d, $c, $dc ,$ca, $img )
    {
        $this->id_Contenu = $id_Contenu;
        $this->titre = $t;
        $this->description = $d;
        $this->fichier = $c;
        $this->video = $dc;
        $this->categorie = $ca;
        $this->imagePath = $img;
    }

 
    public function getId_Contenu()
    {
        return $this->id_Contenu;
    }

   
    public function getTitre()
    {
        return $this->titre;
    }

 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

 
    public function getDescription()
    {
        return $this->description;
    }

   
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

 
    public function getFichier()
    {
        return $this->fichier;
    }


    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

  
    public function getVideo()
    {
        return $this->video;
    }
    

    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }
    public function getCategorie()
    {
        return $this->categorie;
    }


    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
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
