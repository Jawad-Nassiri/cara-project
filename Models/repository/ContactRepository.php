<?php

namespace Models\repository;

use PDOException;

class ContactRepository extends BaseRepository
{
    public function saveContactForm($data)
    {
        try {
            $sql = "INSERT INTO messages_contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':subject', $data['subject']);
            $stmt->bindParam(':message', $data['message']);

            return $stmt->execute();
            
        } catch (PDOException $e) {
            echo "Error saving message: " . $e->getMessage();
            return false;
        }
    }
}

