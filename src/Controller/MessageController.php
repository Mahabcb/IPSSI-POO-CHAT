<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Repository\MessageRepository;

class MessageController{

    private MessageRepository $messageRepository;

    public function __construct()
    {
        $this->messageRepository = new MessageRepository;

    }

    public function handleRequest()
    {
        $errors = [];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
      
            if(empty($_POST['name']) or empty($_POST['message']) or strlen($_POST['message']) < 3 )
            {
                $errors[] = "Veuillez remplir tous les champs";
                return $errors;
            }else{
                $user = new User();
                $message = new Message();
                $user->setName($_POST['name']);
                $message->setAuthor($user);
                $message->setContent($_POST['message']);
                $this->messageRepository->addMessages($message->getContent(), $user->getName(), $message->getCreatedAt()->format('Y-m-d H:i:s'));
                header('Location: /');
                exit();
            }
        }
    }
    
    // lister les messages
    public function getMessages()
    {
        return $this->messageRepository->findAll();
    }
}