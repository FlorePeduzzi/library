<?php
include "header.php";

$id = $_GET['id'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();

$author = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();

$category = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    $params = ['id' => $id];

    if (!empty($_POST['title']) && $_POST['title'] != $book['title']) {
        $updates[] = "title = :title";
        $params['title'] = $_POST['title'];
    }
    if (!empty($_POST['author']) && $_POST['author'] != $book['author_idauthor']) {
        $updates[] = "author_idauthor = :idauthor";
        $params['idauthor'] = $_POST['author'];
    }

    if (!empty($_POST['category']) && $_POST['category'] != $book['category_idcategory']) {
        $updates[] = "category_idcategory = :idcategory";
        $params['idcategory'] = $_POST['category'];
    }
    if (!empty($_POST['synopsis']) && $_POST['synopsis'] != $book['synopsis']) {
        $updates[] = "synopsis = :synopsis";
        $params['synopsis'] = $_POST['synopsis'];
    }

    if (!empty($_FILES['cover']['name'])) {
        $newFilename = uniqid() . '_' . basename($_FILES['cover']['name']);
        $dossierTempo = $_FILES['cover']['tmp_name'];
        $dossierSite = 'uploads/' . $newFilename;
        if (move_uploaded_file($dossierTempo, $dossierSite)) {
            $updates[] = "cover = :cover";
            $params['cover'] = $dossierSite;
        }
    }

    if (!empty($updates)) {
        $sql = "UPDATE book SET " . implode(', ', $updates) . " WHERE idbook = :id";
        $statement = $pdo->prepare($sql);
        foreach ($params as $key => &$val) {
            $statement->bindParam($key, $val);
        }

        if ($statement->execute()) {
            header("location:book.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour du livre.";
        }
    }
}
?>


<div class="allmodify">
    <div class="modify">
        <h2 class="text-center mt-3">Modifier le livre</h2>
        <div class="container mt-4">

            <form action="modifybook.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input class="form-control" name="title" type="text" value="<?= $book['title'] ?>">
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Auteur :</label>
                    <select class="form-select" name="author" id="author">
                        <option><?= $book['name'] ?></option>
                        <?php foreach ($author as $oneauthor) { ?>
                            <option value="<?= $oneauthor['idauthor'] ?>" <?= ($oneauthor['idauthor'] == $book['author_idauthor'] ? 'selected' : '') ?>>
                                <?= $oneauthor['name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="form-text">Si l'auteur n'existe pas, <a class="text-decoration-none" href="author.php">ajoutez un nouvel auteur</a> avant de modifier le livre.</div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie :</label>
                    <select class="form-select" name="category" id="category">
                        <option><?= $book['genre'] ?></option>
                        <?php foreach ($category as $onecategory) { ?>
                            <option value="<?= $onecategory['idcategory'] ?>" <?= ($onecategory['idcategory'] == $book['category_idcategory'] ? 'selected' : '') ?>>
                                <?= $onecategory['genre'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="form-text">Si la catégorie n'existe pas, <a class="text-decoration-none" href="category.php">ajoutez une nouvelle catégorie</a> avant de modifier le livre.</div>
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Synopsis :</label>
                    <textarea class="form-control" name="synopsis" id="synopsis" rows="5"><?= $book['synopsis'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="uploads" class="form-label">Image :</label><br>
                    <img src="<?= $book['cover'] ?>" style="max-width: 200px;"><br>
                    <br><input class="form-control" type="file" name="cover" id="uploads"><br>

                    <button type="submit" class="btn btn-outline-secondary">Modifier</button>
                </div>
            </form>
        </div>

       
    </div>
</div>