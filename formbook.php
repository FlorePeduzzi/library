<?php
include "header.php";

if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['category'])) {
    echo "Tous les champs doivent être remplis";
    exit;
}

$title = $_POST['title'];
$author_idauthor = $_POST['author'];
$category_idcategory = $_POST['category'];
$synopsis = $_POST['synopsis'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$check_statement = $pdo->prepare("SELECT COUNT(*) FROM book WHERE title = :title AND
author_idauthor = :idauthor");
$check_statement->bindValue(':title', $title, \PDO::PARAM_STR);
$check_statement->bindValue(':idauthor',$author_idauthor, \PDO::PARAM_INT); 
$check_statement->execute();
$count = $check_statement->fetchColumn();

if ($count > 0) {
    echo "Ce livre existe déjà dans la bibliothèque";
    exit;  
}


$statement = $pdo->prepare("INSERT INTO book 
(title, author_idauthor, category_idcategory,synopsis) 
VALUES (:title, :idauthor, :idcategory, :synopsis)");
$statement->bindValue(':title', $title, \PDO::PARAM_STR);
$statement->bindValue(':idauthor', $author_idauthor, \PDO::PARAM_INT);
$statement->bindValue(':idcategory', $category_idcategory, \PDO::PARAM_INT);
$statement->bindValue(':synopsis', $synopsis, \PDO::PARAM_STR);


$statement->execute();

var_dump($_POST);
?>

<?php
header("location:book.php");
?>

