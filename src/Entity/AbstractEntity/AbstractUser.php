<?php

namespace App\Entity\AbstractEntity;

abstract class AbstractUser {
    protected int $id;
    protected string $name;
    protected array $roles= [
        'ROLE_USER',
        'ROLE_ADMIN',
    ];

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->id = rand(1, 1000);
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

    public function getRoles() : array
    {
        return $this->roles;
    }

    public function addRoles(array $roles) : self
    {
        $this->roles[] = $roles;
        return $this;
    }

}