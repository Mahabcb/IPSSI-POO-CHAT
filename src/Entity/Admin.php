<?php
declare(strict_types=1);

namespace   App\Entity;

use App\AdminActionsInterface;
use App\Entity\AbstractEntity\AbstractUser;

class Admin extends AbstractUser implements AdminActionsInterface{
   

    public function __construct()
    {
        $this->roles = ['ROLE_ADMIN'];
        parent::__construct();
    }

    public function modere() : string
    {
        return 'Je modere';
    }

    public function addChannel() : string
    {
        return 'Je cree un channel';
    }

    public function deleteChannel() : string
    {
        return 'Je supprime un channel';
    }
}