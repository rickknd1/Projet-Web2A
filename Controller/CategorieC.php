<?php
include '../../config.php';
include '../../Model/Categorie.php';

class CategorieC
{
    public function listCategorie()
    {
        $sql = "SELECT * FROM categorie";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCategorie($id)
    {
        $sql = "DELETE FROM categorie WHERE id_categorie = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            header('Location:ListCategorie.php');
        }
    }

    function addCategorie($Categorie)
    {
        // Vérifier si toutes les valeurs nécessaires sont fournies
        if (!$Categorie->getNomcategorie() || !$Categorie->getniveau() || !$Categorie->getImagePath()) {
            echo "Toutes les informations nécessaires ne sont pas fournies.";
            return;
        }
    
        $sql = "INSERT INTO categorie (nom_categorie, niveau, image_path) VALUES (:cn, :ds, :img)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            // Associer les valeurs aux paramètres de la requête préparée
            $query->bindValue(':cn', $Categorie->getNomcategorie());
            $query->bindValue(':ds', $Categorie->getniveau());
            $query->bindValue(':img', $Categorie->getImagePath());
            $query->execute();
            echo "Catégorie ajoutée avec succès.";
        } catch (Exception $e) {
            echo 'Erreur lors de l\'ajout de la catégorie : ' . $e->getMessage();
        }
    }
    

    function updateCategorie($Categorie, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE categorie SET 
                    nom_categorie = :nomcategorie, 
                    niveau = :niveau,
                    image_path = :image_path 
                WHERE id_categorie= :id_categorie'
            );
            $query->execute([
                'id_categorie' => $id,
                'nomcategorie' => $Categorie->getNomcategorie(),
                'niveau' => $Categorie->getniveau(),
                'image_path' => $Categorie->getImagePath()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showCategorie($id)
    {
        $sql = "SELECT * from categorie where id_categorie = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $Categorie = $query->fetch();
            return $Categorie;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function getCategorieImagePath($categorieId)
    {
        $query = "SELECT image_path FROM categorie WHERE id_categorie = ?";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $categorieId);
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
