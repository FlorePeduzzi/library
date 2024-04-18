
formbook 
if (empty($_POST['title']) || empty($_POST['author']) || empty($_POST['category'])) {
    echo "Tous les champs doivent être remplis";
    exit;
}

<?php

$title = $_POST['title'];
$author_idauthor = $_POST['author'];
$category_idcategory = $_POST['category'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement = $pdo->prepare("INSERT INTO book (title, author_idauthor, category_idcategory) 
VALUES (:title, :idauthor, :idcategory)");
$statement->bindValue(':title', $title, \PDO::PARAM_STR);
$statement->bindValue(':idauthor', $author_idauthor, \PDO::PARAM_INT);
$statement->bindValue(':idcategory', $category_idcategory, \PDO::PARAM_INT);

$statement->execute();

var_dump($_POST);
?>

<?php
header("location:book.php");
?>




<!-- $statement=$pdo->query("SELECT * FROM library.book WHERE idbook=$id");*/-->

<?php
//Démarre ou restaure une session 
session_start();

// Définition d'une variable de session
$_SESSION['nom_utilisateur'] = 'John';

// Accès à la variable de session
echo 'Bonjour, ' . $_SESSION['nom_utilisateur'];
?> 

$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();

$author = $statement->fetchAll(PDO::FETCH_ASSOC);




    $statement = $pdo->prepare("SELECT * FROM book WHERE idbook = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$book = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();

$author = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();

$category = $statement->fetchAll(PDO::FETCH_ASSOC);




<form action="formbook.php" method="POST">

    Titre : <input type="text" name="title">



    <input type="submit" value="Valider">
</form>
<hr>




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


Catégorie :
    <select class="form-label" name="categories" id="categories" required>
        <?php foreach ($categories as $onecategorie) { ?>
            <option value="<?= $onecategorie['idcategories'] ?>" <?= $livres['genre'] === $onecategorie['genre'] ? 'selected' : '' ?>>
                <?= $onecategorie['genre'] ?>
            </option>
        <?php } ?>
    </select><br>


    Category :
    <select class="form-label" name="category" id="category">
        <option><?= $book['genre'] ?></option>
        <?php foreach ($category as $onecategory) {
            echo '<option value="' . $onecategory['idcategory'] . '"' .
                ($onecategory['idcategory'] == $book['category_idcategory'] ? ' selected' : '') . '>'
                . $onecategory['genre'] . '</option>';
        } ?>
    </select><br>

    Auteur :
    <select name="author" id="author">
        <option><?= $book['name'] ?></option>
        <?php foreach ($author as $oneauthor) {
        echo '<option value="' . $oneauthor['idauthor'] . '"' . ($oneauthor['idauthor'] == $book['author_idauthor'] ?
         ' selected' : '') . '>' . $oneauthor['name'] . '</option>';
    } ?>
    </select><br>

    Auteur :
    <select name="author" id="author" required>
        <option>Choisissez un auteur</option>
        <?php foreach ($authors as $oneauthor) { ?>
            <option value="<?= $oneauthor['idauthor'] ?>"><?= $oneauthor['name'] ?></option>
        <?php } ?>
    </select>



    Auteur :
    <select class="form-label" name="author" id="author">
        <option><?= $book['name'] ?></option>
        <?php foreach ($author as $oneauthor) { ?>
            <option value="<?= $oneauthor['idauthor'] ?>"><?= $oneauthor['name'] ?></option>
        <?php } ?>
    </select><br>


    Catégorie :
    <select class="form-label" name="category" id="category" required>
        <?php foreach ($category as $onecategory) { ?>
            <option value="<?= $onecategory['idcategory'] ?>" 
            <?= $book['genre'] === $onecategory['genre'] ? 'selected' : '' ?>>
                <?= $onecategory['genre'] ?>
            </option>
        <?php } ?>
    </select><br>


    --Book--
    Auteur :
    <select class="form-label" name="author" id="author" required>
        <option>Choisissez un auteur</option>
        <?php foreach ($author as $oneauthor) { ?>
            <option value="<?= $oneauthor['idauthor'] ?>"><?= $oneauthor['name'] ?></option>
        <?php } ?>
    </select><br>
    <div class="form-label">Si l'auteur n'existe pas, 
       <a href="author.php">ajouter un nouvel auteur
       </a>avant de saisir votre nouveau livre.
    </div>
 

    Category :
    <select class="form-label" name="category" id="category" required>
        <option>Choisissez une catégorie</option>
        <?php foreach ($category as $onecategory) { ?>
            <option value="<?= $onecategory['idcategory'] ?>"><?= $onecategory['genre'] ?>
            </option>
        <?php } ?>
    </select>