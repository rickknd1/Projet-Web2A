<?php
include '../../config.php';
include '../../Model/Contenu.php';
class ContenuC
{
    public function listContenus()
    {
        $sql = "SELECT * FROM Contenu";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteContenu($id)
    {
        $sql = "DELETE FROM Contenu WHERE id_Contenu = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addContenu($Contenu)
    {
        $sql = "INSERT INTO Contenu  
        VALUES (NULL, :tr,:ds,:cn,:dc,:ca,:img)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'tr' => $Contenu->getTitre(),
                'ds' => $Contenu->getDescription(),
                'cn' => $Contenu->getFichier(),
                'dc' => $Contenu->getVideo(),
                'ca' => $Contenu->getCategorie(),
                'img' => $Contenu->getImagePath()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateContenu($Contenu, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE Contenu SET 
                    titre = :titre, 
                    description = :description,
                    fichier = :fichier,
                    video = :video, 
                    categorie = :categorie,
                    image_path = :image_path
                WHERE id_Contenu= :id_Contenu'
            );
            
            $query->execute([
                'id_Contenu' => $id,
                'titre' => $Contenu->getTitre(),
                'description' => $Contenu->getDescription(),
                'fichier' => $Contenu->getFichier(),
                'video' => $Contenu->getVideo(),
                'categorie' => $Contenu->getCategorie(),
                'image_path' => $Contenu->getImagePath()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showContenu($id)
    {
        $sql = "SELECT * from Contenu where id_Contenu = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $Contenu = $query->fetch();
            return $Contenu;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getContenuImagePath($contenuId)
    {
        $query = "SELECT image_path FROM contenu WHERE id_contenu  = ?";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $contenuId);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['image_path'];
            } else {
                return null;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
