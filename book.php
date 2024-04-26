<?php

include "header.php";


$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement = $pdo->query("select * from book");
$book = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM book ORDER BY title");
$statement->execute();
$book = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();
$author = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();
$category = $statement->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <h1 class="text-center mt-5">Liste des livres</h1>
    <a href="add_book.php" class="btn btn-outline-secondary" style="margin-left:30px;">Ajouter un nouveau livre</a>

    <div class="containerbooks">
        <div class="row">
            <?php foreach ($book as $onebook) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card" style="height: 100%;">
                        <img src="<?= $onebook['cover'] ?>" class="card-img-top" style="object-fit: contain; height: 200px; margin-top:15px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="detailbook.php?id=<?= $onebook['idbook'] ?>"><?= $onebook['title'] ?></a></h5>
                            <p class="card-text">
                                <?php
                                foreach ($author as $oneauthor) {
                                    if ($oneauthor['idauthor'] === $onebook['author_idauthor']) {
                                        echo $oneauthor['name'];
                                        break;
                                    }
                                }
                                ?>

                                <br>
                                <?php
                                foreach ($category as $onecategory) {
                                    if ($onecategory['idcategory'] === $onebook['category_idcategory']) {
                                        echo $onecategory['genre'];
                                        break;
                                    }
                                }
                                ?>
                            </p>
                            <div>
                                <a href="deletebook.php?id=<?= $onebook['idbook'] ?>" class="btn btn-outline-secondary">Supprimer</a>
                                <a href="modifybook.php?id=<?= $onebook['idbook'] ?>" class="btn btn-outline-secondary">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>