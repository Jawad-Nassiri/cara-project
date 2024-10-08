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

    public function findAll($tableName) {

        $sql = "SELECT * FROM $tableName";
        $query = $this->connection->query($sql);
        
        $query->setFetchMode(\PDO::FETCH_CLASS, Product::class);
        
        $result = $query->fetchAll();
        return $result;
    }

    public function findProductById($id) {
        $sql = "SELECT * FROM produit WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetchObject(Product::class);
    }
}

