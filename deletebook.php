<?php

$id=$_GET['id'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$pdo->exec("DELETE FROM book WHERE idbook=$id");

header("location:book.php");

?>
