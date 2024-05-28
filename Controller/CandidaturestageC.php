<?php

include_once 'C:\xampp\htdocs\2A34\Main-main\config.php';
include_once 'C:\xampp\htdocs\2A34\Main-main\Model\candidaturestage.php';

class candidaturestageC
{
    public function listcandidaturestages()
    {
        $sql = "SELECT * FROM candidaturestage";
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
    public function deletecandidaturestage($id)
    {
        $sql = "DELETE FROM candidaturestage WHERE candidaturestage_id=:candidaturestage_id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':candidaturestage_id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addcandidaturestage(candidaturestage $candidaturestage)
    {
        $sql = "INSERT INTO candidaturestage VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
    
            // Récupère les valeurs des propriétés de l'objet candidaturestage
            $offre_id = $candidaturestage->getOffreId();
            $user_id = $candidaturestage->getUserId();
            $date_candidaturestage = $candidaturestage->getDatecandidaturestage();
            $lettre_motivation = $candidaturestage->getLettreMotivation();
            $cv_path = $candidaturestage->getCvPath();
            $statut = $candidaturestage->getStatut();
    
            // Bind parameters
            $query->bindParam(1, $offre_id);
            $query->bindParam(2, $user_id);
            $query->bindParam(3, $date_candidaturestage);
            $query->bindParam(4, $lettre_motivation);
            $query->bindParam(5, $cv_path);
            $query->bindParam(6, $statut);
    
            // Exécute la requête
            $query->execute();
        } catch (Exception $e) {
            echo 'Error ajout :' . $e->getMessage();
        }
    }
    public function updatecandidaturestageStatut($candidaturestage_id, $new_statut)
{
    try {
        $sql = "UPDATE candidaturestage SET statut = :new_statut WHERE candidaturestage_id = :candidaturestage_id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindParam(':new_statut', $new_statut);
        $req->bindParam(':candidaturestage_id', $candidaturestage_id);
        $req->execute();
        echo $req->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function candidaturestageExistsForOffre($offre_id, $user_id)
{
    $sql = "SELECT COUNT(*) FROM candidaturestage WHERE offre_id = :offre_id AND user_id = :user_id";
    $db = config::getConnexion();
    try {
        $req = $db->prepare($sql);
        $req->bindParam(':offre_id', $offre_id);
        $req->bindParam(':user_id', $user_id);
        $req->execute();
        $count = $req->fetchColumn(); // Récupère le nombre de résultats

        return ($count > 0); // Retourne true si au moins une candidaturestage existe, sinon false
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
}

public function getStatutcandidaturestageByOffreId($offre_id)
    {
        $sql = "SELECT statut FROM candidaturestage WHERE offre_id = :offre_id";
        $db = config::getConnexion();
        
        try {
            $req = $db->prepare($sql);
            $req->bindParam(':offre_id', $offre_id);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['statut']; // Retourne le statut de la candidaturestage si trouvé
            } else {
                return "Aucune candidaturestage trouvée pour cette offre.";
            }
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }public function getOffreIdBycandidaturestageId($candidaturestage_id)
    {
        $sql = "SELECT offre_id FROM candidaturestage WHERE candidaturestage_id = :candidaturestage_id";
        $db = config::getConnexion();
        
        try {
            $req = $db->prepare($sql);
            $req->bindParam(':candidaturestage_id', $candidaturestage_id);
            $req->execute();
            
            $result = $req->fetch(PDO::FETCH_ASSOC);
    
            if ($result && isset($result['offre_id'])) {
                return $result['offre_id']; // Retourne l'offre_id de la candidaturestage si trouvé
            } else {
                return null; // Retourne null si la candidaturestage n'est pas trouvée ou si offre_id n'est pas défini
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null; // Retourne null en cas d'erreur
        }
    }
    


    
}
?>
