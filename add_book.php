<?php

include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

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

<div class="allbooks">
    <div class="books">

        <h2 class="text-center mt-5">Ajouter un nouveau livre</h2>

        <div class="container mt-3">
            <form action="formbook.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input class="form-control" name="title" type="text" id="title">
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Auteur :</label>
                    <select class="form-select" name="author" id="author" required>
                        <option>Choisissez un auteur</option>
                        <?php foreach ($author as $oneauthor) { ?>
                            <option value="<?= $oneauthor['idauthor'] ?>"><?= $oneauthor['name'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="form-text">Si l'auteur n'existe pas, <a class="text-decoration-none" href="author.php">ajoutez un nouvel auteur</a> avant de saisir votre nouveau livre.</div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie :</label>
                    <select class="form-select" name="category" id="category" required>
                        <option>Choisissez une catégorie</option>
                        <?php foreach ($category as $onecategory) { ?>
                            <option value="<?= $onecategory['idcategory'] ?>"><?= $onecategory['genre'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="form-text">Si la catégorie n'existe pas, <a class="text-decoration-none" href="category.php">ajoutez une nouvelle catégorie</a> avant de saisir votre nouveau livre.</div>
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Synopsis :</label>
                    <textarea class="form-control" name="synopsis" id="synopsis" rows="10" cols="80"></textarea>
                </div>

                <div class="mb-3">
                    <label for="uploads" class="form-label">Image :</label>
                    <input type="file" name="cover" id="uploads"><br>
                    <br><input type="submit" value="Valider" class="btn btn-outline-secondary">
                </div>
            </form>
        </div>
    </div>
</div>