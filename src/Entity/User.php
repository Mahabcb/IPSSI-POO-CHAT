<?php
declare(strict_types=1);

namespace   App\Entity;

use App\Entity\AbstractEntity\AbstractUser;

class User extends AbstractUser{
   
    public function __construct()
    {
        parent::__construct();
    }
}