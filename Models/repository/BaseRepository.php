<?php

namespace Models\repository;

use Models\Database;
use Models\entity\Product;

abstract class BaseRepository {

    protected $db;
    protected $connection;

    public function __construct() {
        $this->db = new Database;
        $this->connection = $this->db->dbConnect();
    }

    // Find all products (generic method)
    public function findAll($tableName) {

        $sql = "SELECT * FROM $tableName";
        $query = $this->connection->query($sql);
        
        $query->setFetchMode(\PDO::FETCH_CLASS, Product::class);
        
        $result = $query->fetchAll();
        return $result;
    }

    // Find a product by its ID
    public function findProductById($id) {
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchObject(Product::class);
    }

    // Add a product
    public function addProduct($categorie, $titre, $marque, $description, $public, $photo, $prix, $stock) {
        $query = "INSERT INTO product (categorie, titre, marque, description, public, photo, prix, stock) VALUES (:categorie, :titre, :marque, :description, :public, :photo, :prix, :stock)";
        
        $stmt = $this->connection->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':public', $public);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':stock', $stock, \PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }else{

            return false;
        }
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM product WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

