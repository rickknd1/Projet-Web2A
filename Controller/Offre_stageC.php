<?php 

include_once 'C:\xampp\htdocs\2A34\Main-main\config.php';
include_once 'C:\xampp\htdocs\2A34\Main-main\Model\Offre_stage.php';

class Offres_stageC
{
    public function listOffrestage()
    {
        $sql = "SELECT * FROM offres_stage";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }
    public static function styleContentBackOffice($contenido)
    {
        // Dividir el contenido en párrafos usando nl2br
        $contenido = nl2br($contenido);
    
        // Cortar el contenido si es demasiado largo
        $max_length = 25; // Mostrar solo 50 caracteres
        if (strlen($contenido) > $max_length) {
            $contenido = substr($contenido, 0, $max_length) . '...';
        }
    
        // Puedes resaltar palabras clave o aplicar otros estilos aquí
        // Ejemplo: resaltar la palabra "clave"
        $contenido = str_replace('clave', '<strong>clave</strong>', $contenido);
    
        // Retorna el contenido estilizado
        return $contenido;
    }
    public function deleteOffrestage($id)
    {
        $sql = "DELETE FROM offres_stage WHERE id=:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addOffrestage(Offres_stage $offre)
    {
        $sql = "INSERT INTO offres_stage VALUES (NULL, :titre, :entreprise, :type_stage, :duree, :domaine, :nombre_place, :description)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);

            // Bind parameters
            /*
            $query->bindParam(':titre', $offre->getTitreOF());
            $query->bindParam(':entreprise', $offre->getEntrepriseOF());
            $query->bindParam(':type_stage', $offre->getTypestageOF());
            $query->bindParam(':duree', $offre->getdureeOF());
            $query->bindParam(':domaine', $offre->getDomaineOF());
            $query->bindParam(':nombre_place', $offre->getNombrePlaceOF());
            $query->bindParam(':description', $offre->getDescriptionOF());
            */
            // Execute query
            $query->execute([
                'titre' => $offre->getTitreOF(),
                'entreprise' => $offre->getEntrepriseOF(),
                'type_stage' => $offre->getTypestageOF(),
                'duree' => $offre->getdureeOF(),
                'domaine' => $offre->getDomaineOF(),
                'nombre_place' => $offre->getNombrePlaceOF(),
                'description' => $offre->getDescriptionOF()
            ]);
        } catch (Exception $e) {
            echo 'Error :' . $e->getMessage();
        }
    }
    public function updateOffrestage($offre, $id)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE offres_stage SET 
                titre = :titre, 
                entreprise = :entreprise, 
                type_stage = :type_stage, 
                duree = :duree,
                domaine = :domaine,
                nombre_place = :nombre_place,
                description = :description
            WHERE id = :id'
        );
        $query->execute([
            'id' => $id,
            'titre' => $offre->getTitreOF(),
            'entreprise' => $offre->getEntrepriseOF(),
            'type_stage' => $offre->getTypestageOF(),
            'duree' => $offre->getdureeOF(),
            'domaine' => $offre->getDomaineOF(),
            'nombre_place' => $offre->getNombrePlaceOF(),
            'description' => $offre->getDescriptionOF()
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
public function getOffreById($id)
{
    $sql = "SELECT * FROM offres_stage WHERE id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        
        // Fetch the job offer as an associative array
        $offre = $query->fetch(PDO::FETCH_ASSOC);
        
        return $offre; // Return the job offer details
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null; // Return null if an error occurs
    }
}


public function decrementPlaces($id)
{
    $db = config::getConnexion();
    
    // Sélectionner l'offre d'emploi par son ID
    $offre = $this->getOffreById($id);

    if (!$offre) {
        echo "Offre de stage non trouvée.";
        return;
    }

    $nombre_places = $offre['nombre_place'];
    
    if ($nombre_places > 0) {
        $new_nombre_places = $nombre_places - 1;

        try {
            $query = $db->prepare('UPDATE offres_stage SET nombre_place = :nombre_place WHERE id = :id');
            $query->execute([
                'id' => $id,
                'nombre_place' => $new_nombre_places
            ]);

            echo "Nombre de places décrémenté avec succès.";

            // Vérifier si le nombre de places est maintenant zéro pour supprimer l'offre
            /*if ($new_nombre_places === 0) {
                $this->deleteOffre($id);
                echo "<script>alert(''offre d'emploi a été supprimée car le nombre de places est épuisé.');</script>";
                echo "L'offre d'emploi a été supprimée car le nombre de places est épuisé.";
            }*/
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du nombre de places : " . $e->getMessage();
        }
    } else {
        echo "Le nombre de places est déjà épuisé pour cette offre de stage.";
    }
}

public function getNombrePlacesById($id)
{
    $db = config::getConnexion();
    
    try {
        $sql = "SELECT nombre_place FROM offres_stage WHERE id = :id";
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['nombre_place']; // Retourne le nombre de places de l'offre
        } else {
            return 0; // Retourne zéro si aucune offre n'est trouvée pour cet ID
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du nombre de places : " . $e->getMessage();
        return 0; // En cas d'erreur, retourne zéro
    }
}



}  
?>
