<?php

namespace Models;

class Database {
    private $connection = null;

    public function dbConnect() {
        try {
            $pdo = new \PDO('mysql:host=localhost;dbname=cara', 'root', '');
            $this->connection = $pdo;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }

        return $this->connection;
    }
}
