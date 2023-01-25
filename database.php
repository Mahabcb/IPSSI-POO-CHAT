<?php

$connection = mysqli_connect('localhost', 'root', 'root', 'chat');

// création de la bdd
$sql = "CREATE DATABASE IF NOT EXISTS chat";

if(!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}
echo 'Connected successfully' . PHP_EOL;

// création de la table user
$sql = "CREATE TABLE IF NOT EXISTS user(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
    )
";

// création de la table message
$sql = "CREATE TABLE IF NOT EXISTS message(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author varchar(30) NOT NULL,
    content text NOT NULL,
    created_at DATETIME NOT NULL
    )"
;

if(mysqli_query($connection, $sql)) {
    echo 'Table created successfully' . PHP_EOL;
} else {
    echo 'Error creating table: ' . mysqli_error($connection);
}


