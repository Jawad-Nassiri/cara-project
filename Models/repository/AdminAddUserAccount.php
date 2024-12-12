<?php

namespace Models\repository;

use PDOException;
use Models\entity\Sign_Up;

class Sign_UpRepository extends BaseRepository
{
    public function saveAdminUser(Sign_Up $sign_up)
    {
        try {
            $sql = "INSERT INTO member (username, email, password, statut_admin) 
                    VALUES (:username, :email, :password, :statut_admin)";
            
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':username', $sign_up->getUsername());
            $stmt->bindParam(':email', $sign_up->getEmail());
            $stmt->bindParam(':password', $sign_up->getPassword());
            $stmt->bindParam(':statut_admin', $sign_up->getAdminStatus(), \PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Error saving user: " . $e->getMessage();
            return false;
        }
    }
}
