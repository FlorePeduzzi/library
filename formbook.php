
<?php
include "header.php";
$pdo = new PDO('mysql:host=localhost;dbname=library', 'root');

$title = $_POST['title'];
$author_idauthor = $_POST['author'];
$category_idcategory = $_POST['category'];
$synopsis = $_POST['synopsis'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$check_statement = $pdo->prepare("SELECT COUNT(*) FROM book WHERE title = :title AND
author_idauthor = :idauthor");
$check_statement->bindValue(':title', $title, \PDO::PARAM_STR);
$check_statement->bindValue(':idauthor', $author_idauthor, \PDO::PARAM_INT);
$check_statement->execute();
$count = $check_statement->fetchColumn();

if ($count > 0) {
    echo "Ce livre existe déjà dans la bibliothèque";
    exit;
}


try {
    $pdo->beginTransaction();

    if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['category']) || empty($_FILES['cover'])) {
        throw new Exception("Tous les champs et l'image doivent être remplis");
    }

    $title = $_POST['title'];
    $idauthor = $_POST['author'];
    $idcategory = $_POST['category'];
    $synopsis = $_POST['synopsis'];


    $newFilename = uniqid() . '_' . basename($_FILES['cover']['name']);
    $dossierTempo = $_FILES['cover']['tmp_name'];
    $dossierSite = 'uploads/' . $newFilename;
    if (!move_uploaded_file($dossierTempo, $dossierSite)) {
        throw new Exception("Une erreur est survenue lors du téléchargement du fichier");
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("INSERT INTO book (title, author_idauthor, category_idcategory, synopsis, cover) 
    VALUES (:title, :idauthor, :idcategory, :synopsis, :cover)");
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':idauthor', $idauthor, PDO::PARAM_INT);
    $statement->bindValue(':idcategory', $idcategory, PDO::PARAM_INT);
    $statement->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
    $statement->bindValue(':cover', $dossierSite, PDO::PARAM_STR);
    $statement->execute();

    $pdo->commit();
    header("location:book.php");
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Erreur : " . $e->getMessage();
}
