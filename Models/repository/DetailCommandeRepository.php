<?php

namespace Models\repository;

use Models\entity\DetailCommande;
use PDOException;

class DetailCommandeRepository extends BaseRepository {

    public function saveDetailCommande(DetailCommande $detailCommande): bool {
        try {
            $sql = "INSERT INTO detail_commande (commande_id, product_id, size, quantity) 
                    VALUES (:commande_id, :product_id, :size, :quantity)";
            $stmt = $this->connection->prepare($sql);

            $commandeId = $detailCommande->getCommandeId();
            $productId = $detailCommande->getProductId();
            $size = $detailCommande->getSize();
            $quantity = $detailCommande->getQuantity();

            $stmt->bindParam(':commande_id', $commandeId);
            $stmt->bindParam(':product_id', $productId);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':quantity', $quantity);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error saving detail command: " . $e->getMessage();
            return false;
        }
    }

    public function getDetailsByCommandeId(int $commandeId): array {
        try {
            $sql = "SELECT * FROM detail_commande WHERE commande_id = :commande_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':commande_id', $commandeId);
            $stmt->execute();

            $results = $stmt->fetchAll();
            $details = [];

            foreach ($results as $result) {
                $detail = new DetailCommande();
                $detail->setId($result['id']);
                $detail->setCommandeId($result['commande_id']);
                $detail->setProductId($result['product_id']);
                $detail->setSize($result['size']);
                $detail->setQuantity($result['quantity']);

                $details[] = $detail;
            }

            return $details;
        } catch (PDOException $e) {
            echo "Error fetching detail commands: " . $e->getMessage();
            return [];
        }
    }
}
