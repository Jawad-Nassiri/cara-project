<?php

namespace Models\repository;

use PDOException;

class Sign_UpRepository extends BaseRepository
{
    public function saveSign_UpForm($data)
    {
        try {
            $sql = "INSERT INTO member (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':username', $data->getUsername());
            $stmt->bindParam(':email', $data->getEmail());
            $stmt->bindParam(':password', $data->getPassword());

            return $stmt->execute();

        } catch (PDOException $e) {
            echo "Error saving message: " . $e->getMessage();
            return false;
        }
    }
}
