<?php

namespace Models\repository;

use PDO;
use PDOException;

class Sign_InRepository extends BaseRepository {

    public function getUserByUsername($username) {
        try {
            $sql = "SELECT * FROM member WHERE username = :username";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':username', $username); 
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("Error fetching user: " . $e->getMessage()); 
            return false;
        }
    }

    public function getAllUsers() {
        try {
            $sql = "SELECT * FROM member";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            error_log("Error fetching all users: " . $e->getMessage());
            return false;
        }
    }
}
