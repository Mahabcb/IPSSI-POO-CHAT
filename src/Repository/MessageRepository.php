<?php

namespace App\Repository;

use App\Connection;
use App\QueryBuilder;

class MessageRepository extends QueryBuilder{

    private $connection;
    protected $table = "message";

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /**
     * On veut récupérer les données d'ue table
     */

     public function findAll(): array
     {
         $sql = $this->select("author, content, created_at");
         $sql .= $this->order("created_at DESC");
         return $this->connection->query($sql)->fetchAll();
 
     }

    /**
     * On veut récupérer les données d'une ligne
     */
    public function find(int $id)
    {
        $sql = $this->select("author, content, created_at");
        $sql .= $this->where("id = :id");
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
    public function addMessages(string $content, string $author, string $created_at)
    {
        $sql = "INSERT INTO message (content, author, created_at) VALUES (:content, :author, :created_at)";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'content' => $content,
            'author' => $author,
            'created_at' => $created_at
        ]);
    }

    public function removeMessage()
    {
        $sql = "DELETE FROM message WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $_GET['id']
        ]);
    }
}