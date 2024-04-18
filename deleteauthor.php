<?php

$id=$_GET['id'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$pdo->exec("DELETE FROM author WHERE idauthor=$id");

header("location:author.php");

?>