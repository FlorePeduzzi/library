<?php

$id=$_GET['id'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$pdo->exec("DELETE FROM category WHERE idcategory=$id");

header("location:category.php");

?>