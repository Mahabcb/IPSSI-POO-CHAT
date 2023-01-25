<?php
declare(strict_types=1);

namespace   App\Entity;

class User{
    
    private int $id;
    private string $name;

    public function __construct()
    {
        $this->id = rand(1, 100);
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

}