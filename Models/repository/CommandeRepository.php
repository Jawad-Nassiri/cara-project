<?php

namespace Models\repository;

use Models\entity\Commande;
use PDOException;

class CommandeRepository extends BaseRepository {

    public function saveCommande(Commande $commande) {
        $montant = $commande->getMontant();
        $dateEnregistrement = $commande->getDateEnregistrement();
        $idMembre = $commande->getIdMembre();
    
        $sql = "INSERT INTO commande (montant, date_enregistrement, id_membre) 
                VALUES (:montant, :date_enregistrement, :id_membre)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':date_enregistrement', $dateEnregistrement);
        $stmt->bindParam(':id_membre', $idMembre);
    
        if ($stmt->execute()) {
            $commande->setId($this->connection->lastInsertId());
            return true;
        }
    
        return false;
    }
    
    

    public function getCommandeById(int $id): ?Commande {
        try {
            $sql = "SELECT * FROM commande WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch();
            if ($result) {
                $commande = new Commande();
                $commande->setId($result['id']);
                $commande->setMontant($result['montant']);
                $commande->setDateEnregistrement($result['date_enregistrement']);
                $commande->setIdMembre($result['id_membre']);

                return $commande;
            }
            return null;
        } catch (PDOException $e) {
            echo "Error fetching command: " . $e->getMessage();
            return null;
        }
    }
}
