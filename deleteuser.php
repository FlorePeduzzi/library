<?php

$id=$_GET['id'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$pdo->exec("DELETE FROM user WHERE iduser=$id");

header("location:user.php");

?>