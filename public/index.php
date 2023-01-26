<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Entity\User;
use App\Entity\Message;

$messageController = new App\Controller\MessageController();
$messages = $messageController->getMessages();
$messageController->handleRequest();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body class="bg-gray-100">
    <div class="container mx-auto py-10">
      <h1 class="text-3xl font-medium text-center">Chat</h1>
      
      <div class="bg-white p-6 rounded-lg shadow-md">
        <form id="form-message" method="post">
          <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="name">Nom</label>
            <input class="bg-gray-200 p-2 rounded-lg w-full" type="text" id="name" name="name" >
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2" for="message">Message</label>
            <textarea class="bg-gray-200 p-2 rounded-lg w-full" id="message" name="message" ></textarea>
          </div>
          <div class="text-center">
            <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Envoyer</button>
          </div>
        </form>
      </div>
      
      <div class="bg-white p-6 rounded-lg shadow-md mt-10" id="messages">
        <h2 class="text-lg font-medium mb-4">Messages</h2>
        <ul class="list-none">
          <?php foreach($messages as $message): ?>
            <li class="mb-4">
              <div class="bg-gray-200 p-4 rounded-lg">
                <p class="font-medium"><?= $message['author'] ?></p>
                <p><?= $message['content'] ?></p>
                <p class="text-xs text-right"><?= $message['created_at'] ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        <ul class="list-none">

        </ul>
      </div>
    </div>
  </body>
</html>