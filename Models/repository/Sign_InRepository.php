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

    public function getUserById($userId) {
        try {
            $sql = "SELECT * FROM member WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching user by ID: " . $e->getMessage());
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

    // delete user by admin  
    public function deleteUserById($userId) {
        try {
            $sql = "DELETE FROM member WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->rowCount() > 0; // returns true if the user was deleted
        } catch (PDOException $e) {
            error_log("Error deleting user: " . $e->getMessage());
            return false;
        }
    }


    // edit user by admin 
    public function updateUserById($userId, $username, $email, $statutAdmin) {
        try {

            $sql = "UPDATE member SET username = :username, email = :email, statut_admin = :statut_admin WHERE id = :id";
            
            $stmt = $this->connection->prepare($sql);
            
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':statut_admin', $statutAdmin, PDO::PARAM_INT);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating user: " . $e->getMessage());
            return false;
        }
    }     


}
