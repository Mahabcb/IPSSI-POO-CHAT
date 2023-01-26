<?php

namespace App;

use App\Connection;

abstract class QueryBuilder{
    protected $connection;
    protected $table;

    public function __construct() 
    {
        $this->connection = Connection::getConnection();
    }

    public function select(string $select)
    {
        $sql = "SELECT $select from {$this->table}";
        return $sql;
    }

    public function order(string $order)
    {
        return " ORDER BY $order";
    }

    public function where(mixed $where)
    {
        return " WHERE $where";
    }

    public function insert()
    {
        $sql = "INSERT INTO {$this->table} (content, author, created_at) VALUES (:content, :author, :created_at)";
        return $sql;
    }

}