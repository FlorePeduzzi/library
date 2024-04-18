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

$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();

$author = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();

$category = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($id);
?>

<form action="modifybook.php?id=<?= $id ?>" method="POST">

    Titre :
    <input class="form-label" name="title" type="text" value="<?= $book['title'] ?>"><br>

    Auteur :
    <select name="author" id="author">
        <option><?= $book['name'] ?></option>
        <?php foreach ($author as $oneauthor) {
        echo '<option value="' . $oneauthor['idauthor'] . '"' . ($oneauthor['idauthor'] 
        == $book['author_idauthor'] ?
         ' selected' : '') . '>' . $oneauthor['name'] . '</option>';
    } ?>
    </select><br>

    Category :
    <select class="form-label" name="category" id="category">
        <option><?= $book['genre'] ?></option>
        <?php foreach ($category as $onecategory) {
            echo '<option value="' . $onecategory['idcategory'] . '"' .
                ($onecategory['idcategory'] 
                == $book['category_idcategory'] ? ' selected' : '') . '>'
                . $onecategory['genre'] . '</option>';
        } ?>
    </select><br>

    Synopsis :<br>
    <textarea class="form-label" name="synopsis" type="text" 
    rows="10" cols="80"></textarea><br>


    <input type="submit" value="Modifier">

</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author_idauthor = $_POST['author'];
    $category_idcategory = $_POST['category'];
    $synopsis = $_POST['synopsis'];

    $statement = $pdo->prepare("UPDATE book SET title = :title, 
        author_idauthor = :idauthor, category_idcategory = :idcategory, synopsis = :synopsis 
        WHERE idbook = :id");
    $statement->bindValue(':title', $title, \PDO::PARAM_STR);
    $statement->bindValue(':idauthor', $author_idauthor, \PDO::PARAM_INT);
    $statement->bindValue(':idcategory', $category_idcategory, \PDO::PARAM_INT);
    $statement->bindValue(':synopsis', $synopsis, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        echo "La mise à jour du livre a bien été effectuée.";
    } else {
        echo "Erreur lors de la mise à jour du livre.";
    }
}
?>

<br>Retourner à <a href="book.php">la liste des livres</a>