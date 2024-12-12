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

            $stmt->bindParam(':montant', $commande->getMontant());
            $stmt->bindParam(':size', $commande->getSize());
            $stmt->bindParam(':date_enregistrement', $commande->getDateEnregistrement());
            $stmt->bindParam(':id_membre', $commande->getIdMembre());
            $stmt->bindParam(':product_id', $commande->getProductId());

            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Error saving command: " . $e->getMessage();
            return false;
        }
    }

    // public function getCommandsByUser(int $userId): array {
    //     try {
    //         $sql = "SELECT * FROM commande WHERE id_membre = :id_membre";
    //         $stmt = $this->connection->prepare($sql);
    //         $stmt->bindParam(':id_membre', $userId);
    //         $stmt->execute();

    //         return $stmt->fetchAll();
    //     } catch (PDOException $e) {
    //         echo "Error retrieving commands: " . $e->getMessage();
    //         return [];
    //     }
    // }
}
