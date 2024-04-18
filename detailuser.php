<?php

include "header.php";
$id=$_GET['id'];
var_dump($_GET);
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement=$pdo->query("SELECT * FROM library.user WHERE iduser=$id");

$user=$statement->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
var_dump($user);
echo "</pre>";
?>

Vous avez sélectionné l'auteur : 
<?=$user['name']?>