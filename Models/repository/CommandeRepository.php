<?php

namespace Models\repository;

use Models\entity\Commande;
use PDOException;

class CommandeRepository extends BaseRepository {

    public function saveCommand(Commande $commande): bool {
        try {
            $sql = "INSERT INTO commande (montant, size, date_enregistrement, id_membre, product_id) 
                    VALUES (:montant, :size, :date_enregistrement, :id_membre, :product_id)";
            $stmt = $this->connection->prepare($sql);
    
            $montant = $commande->getMontant();
            $size = $commande->getSize();
            $dateEnregistrement = $commande->getDateEnregistrement();
            $idMembre = $commande->getIdMembre();
            $productId = $commande->getProductId();
    
            $stmt->bindParam(':montant', $montant);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':date_enregistrement', $dateEnregistrement);
            $stmt->bindParam(':id_membre', $idMembre);
            $stmt->bindParam(':product_id', $productId);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error saving command: " . $e->getMessage();
            return false;
        }
    }
    
}
