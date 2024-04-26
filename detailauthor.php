<?php

include "header.php";
$id = $_GET['id'];


$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement = $pdo->query("SELECT * FROM library.author WHERE idauthor=$id");

$author = $statement->fetch(PDO::FETCH_ASSOC);

?>

<div class="cardcontainer">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h4 class="card-title text-center" style="margin-top:20px; margin-top:20px;"><?= $author['name'] ?>
            </h4>
            <p class="card-text text-center">
                <img src="<?= $author['picture'] ?>" class="card-img-top" style="object-fit: contain; height:300px; margin-top:10px; margin-bottom:15px;">

                <?php
                $book_statement = $pdo->prepare("SELECT * FROM book WHERE author_idauthor = :idauthor");
                $book_statement->bindValue(':idauthor', $id, \PDO::PARAM_INT);
                $book_statement->execute();

                $book = $book_statement->fetchAll(PDO::FETCH_ASSOC);
                ?>Livres de l'auteur
                <?= $author['name'] ?> :<br>
                <?php foreach ($book as $onebook) { ?>
                    <a href="detailbook.php?id=<?= $onebook['idbook'] ?>">
                        <?= $onebook['title'] ?></a><br>
                <?php
                }
                ?>
            </p>
            <p>
                Bio : <tr><?= $author['bio'] ?>
            </p>
        </div>
    </div>
</div>