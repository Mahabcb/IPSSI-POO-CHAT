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
        <?php foreach() ?>
          <?php endforeach ?>
        <ul class="list-none">

        </ul>
      </div>
    </div>
  </body>
</html>

<?php

require_once __DIR__ . '/../vendor/autoload.php';



use App\Entity\User;
use App\Entity\Message;
// ajouter une variable $error qui contient un tableau vide

 if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_POST['name']) and !empty($_POST['message']) and strlen($_POST['message'] > 3) )
  {
    $connection =  mysqli_connect('localhost', 'root', 'root', 'chat');
    if(!$connection) {
      die('Connection failed: ' . mysqli_connect_error());
    }

    $user = new User;
    $user->setName($_POST['name']);
    $message = new Message;
    $message->setContent($_POST['message'])
            ->setAuthor($user);

    $sql_user = "INSERT INTO user (name) VALUES ('" . $user->getName() . "')";
    $sql_message =  "INSERT INTO message (content, author, created_at) VALUES ('" . $message->getContent() . "', '" . $user->getName() . "', '" . $message->getCreatedAt()->format("Y-m-d H:i:s") . "')";
    if (mysqli_query($connection, $sql_user)) {
      echo "New record for table user created successfully";
    } else {
      echo "Error: " . $sql_user . "<br>" . mysqli_error($connection);
    }

    if (mysqli_query($connection, $sql_message)) {
      echo "New record for table message created successfully";
    } else {
      echo "Error: " . $sql_message . "<br>" . mysqli_error($connection);
    }
    mysqli_close($connection);
    header('Location: /');
    exit;
  }
}
?>