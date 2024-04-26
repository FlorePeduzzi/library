<?php

include "header.php";
$id = $_GET['id'];


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

?>
<div class="cardcontainer">
    <div class="card" style="width: 25rem;">

        <img src="<?= $book['cover'] ?>" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">Vous avez sélectionné le livre <?= $book['title'] ?>
                de l'auteur <?= $book['name'] ?> / catégorie
                <?= $book['genre'] ?></h5><br>
            <p class="card-text">Synopsis :
                <?= $book['synopsis'] ?></p><br>

        </div>
    </div>
</div>


</body>

</html>