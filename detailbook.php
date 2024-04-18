<?php

include "header.php";
$id = $_GET['id'];
var_dump($_GET);

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement = $pdo->prepare("SELECT book.*, author.name, category.genre
FROM book 
JOIN author 
ON book.author_idauthor = author.idauthor
JOIN category
ON book.category_idcategory = category.idcategory
WHERE idbook = :id");

$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$book = $statement->fetch(PDO::FETCH_ASSOC);


echo "<pre>";
var_dump($book);
echo "</pre>";

?>

<h4>Vous avez sélectionné le livre
    <?= $book['title'] ?>

    de l'auteur
    <?= $book['name'] ?>

    / catégorie
    <?= $book['genre'] ?></h4>
<br>

<h4>Synopsis :</h4>
<?= $book['synopsis'] ?><br>
</body>

</html>