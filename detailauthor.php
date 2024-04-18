<?php

include "header.php";
$id=$_GET['id'];
var_dump($_GET);

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement=$pdo->query("SELECT * FROM library.author WHERE idauthor=$id");

$author=$statement->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
var_dump($author);
echo "</pre>";
?>

Vous avez sélectionné l'auteur 
<?=$author['name']?>

<?php
$book_statement = $pdo->prepare("SELECT * FROM book WHERE author_idauthor = :idauthor");
$book_statement->bindValue(':idauthor', $id, \PDO::PARAM_INT);
$book_statement->execute();

$book = $book_statement->fetchAll(PDO::FETCH_ASSOC);
?>

<br>Livres de l'auteur <?=$author['name']?> :<br>
<?php foreach ($book as $onebook){ ?>
    <a href="detailbook.php?id=<?=$onebook['idbook']?>">
        <?=$onebook['title']?></a><br>
<?php 
}
?>