<?php

require_once __DIR__ . '/../vendor/autoload.php';



use App\Entity\User;
use App\Entity\Message;
// ajouter une variable $error qui contient un tableau vide

  // AFFICHAQUE DES MESSAGES
  $sql_all_message = "SELECT author, content, created_at FROM message ORDER BY created_at DESC";
  $pdo = new PDO('mysql:host=localhost;dbname=chat', 'root', 'root',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
  $result = $pdo->query($sql_all_message);
  $messages = $result->fetchAll();

 // INSERTION DES DONNEES DANS LA BDD
 if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_POST['name']) and !empty($_POST['message']) and strlen($_POST['message'] > 3) )
  {
    $pdo = new PDO('mysql:host=localhost;dbname=chat', 'root', 'root',[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $user = new User;
    $user->setName($_POST['name']);
    $message = new Message;
    $message->setContent($_POST['message'])
            ->setAuthor($user);

    $query_user = $pdo->prepare("INSERT INTO user (name) VALUES (:name)");
    $query_user->execute([
      'name' => $user->getName()
    ]);

    $query_message = $pdo->prepare("INSERT INTO message (content, author, created_at) VALUES (:content, :author, :created_at)");
    $query_message->execute([
      'content' => $message->getContent(),
      'author' => $user->getName(),
      'created_at' => $message->getCreatedAt()->format("Y-m-d H:i:s")
    ]);
    header('Location: index.php');
    exit;
  }

  // $messageController = new MessageController;
  // $messages = $messageController->getMessages();
  // $messageController->handleRequest();
}
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