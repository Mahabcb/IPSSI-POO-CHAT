<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use App\Entity\User;

class Message{

    private int $id;
    private User $author;
    private string $content;
    private DateTime $createdAt;

    public function __construct()
    {
        $this->id = rand(1, 1000);
        $this->createdAt = new DateTime("Europe/Paris");
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getAuthor() : ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author) : self
    {
        $this->author = $author;
        return $this;
    }

    public function setContent(string $content) : self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent() : ?string
    {
        return $this->content;
    }

    public function getCreatedAt() : ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt) : self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}