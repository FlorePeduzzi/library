<?php

include "header.php";
$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement = $pdo->query("SELECT * FROM category WHERE idcategory=$id");
$category = $statement->fetch(PDO::FETCH_ASSOC);



?>
<div class="cardcontainer">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Vous avez sélectionné la catégorie 
                <?= $category['genre'] ?>

            </h5>
            <p class="card-text">
            <img src="<?= $category['illustration'] ?>" class="card-img-top" style="object-fit: contain; margin-top:15px; margin-bottom:15px;">

                <?php
                $book_statement = $pdo->prepare("SELECT * FROM book WHERE category_idcategory = :idcategory");
                $book_statement->bindValue(':idcategory', $id, \PDO::PARAM_INT);
                $book_statement->execute();

                $book = $book_statement->fetchAll(PDO::FETCH_ASSOC);
                ?>

                Livres de la catégorie <?= $category['genre'] ?> :<br>
                <?php foreach ($book as $onebook) { ?>
                    <a href="detailbook.php?id=<?= $onebook['idbook'] ?>">
                        <?= $onebook['title'] ?></a><br>
                <?php
                }
                ?>
            </p>
        </div>
    </div>