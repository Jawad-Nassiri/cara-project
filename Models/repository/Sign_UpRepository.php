<?php

namespace Models\repository;

use PDOException;
use Models\entity\Sign_Up;

class Sign_UpRepository extends BaseRepository
{
    public function saveSign_UpForm(Sign_Up $sign_up)
    {
        try {
            $sql = "INSERT INTO member (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':username', $sign_up->getUsername());
            $stmt->bindParam(':email', $sign_up->getEmail());
            $stmt->bindParam(':password', $sign_up->getPassword());

            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Error saving message: " . $e->getMessage();
            return false;
        }
    }
}
