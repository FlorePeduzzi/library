<?php

include "header.php";
$id=$_GET['id'];
var_dump($_GET);

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement=$pdo->query("SELECT * FROM category WHERE idcategory=$id");
$category=$statement->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($category);
echo "</pre>";
?>

Vous avez sélectionné la catégorie : 
<?=$category['genre']?>
<br>

<?php
$book_statement = $pdo->prepare("SELECT * FROM book WHERE category_idcategory = :idcategory");
$book_statement->bindValue(':idcategory', $id, \PDO::PARAM_INT);
$book_statement->execute();

$book = $book_statement->fetchAll(PDO::FETCH_ASSOC);
?>

Livres de la catégorie <?=$category['genre']?> :<br>
<?php foreach ($book as $onebook){ ?>
    <a href="detailbook.php?id=<?=$onebook['idbook']?>">
        <?=$onebook['title']?></a><br>
<?php 
}
?>






