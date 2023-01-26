<?php

namespace App\Repository;

use App\Connection;

class UserRepository{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function findAll()
    {
        $sql = "SELECT name FROM user";
        return $this->connection->query($sql)->fetchAll();
    }

    public function find(int $id)
    {
        $sql = "SLECT name FROM user WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public function addUser(string $name)
    {
        $sql = "INSERT INTO user (name) VALUES (:name)";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'name' => $name
        ]);
    }
}