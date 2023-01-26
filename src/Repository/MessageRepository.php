<?php

namespace App\Repository;

use App\Connection;

class MessageRepository{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /**
     * On veut récupérer les données d'ue table
     */

    public function findAll()
    {
        $sql = "SELECT author, content, created_at FROM message";
        return $this->connection->query($sql)->fetchAll();
    }

    /**
     * On veut récupérer les données d'une ligne
     */
    public function find(int $id)
    {
        $sql = "SELECT content, author, created_at from message WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        $item = $query->fetch();
        return $item;
    }
    
    /**
     * On veut ajouter des données dans une table
     */
    public function addMessages(string $message, string $author, string $created_at)
    {
        $sql = "INSERT INTO message (content, author, created_at) VALUES (:content, :author, :created_at)";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'content' => $message,
            'author' => $author,
            'created_at' => $created_at
        ]);
    }
}