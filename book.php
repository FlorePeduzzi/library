<?php

include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement = $pdo->prepare("SELECT * FROM book");
$statement->execute();
$book=$statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();

$author = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();

$category = $statement->fetchAll(PDO::FETCH_ASSOC);



echo "<pre>";
var_dump($book);
echo "</pre>";

?>

<hr>
<h1>Liste des livres</h1>

<?php

foreach ($book as $onebook){ ?>
    <a href="detailbook.php?id=<?=$onebook['idbook']?>">
        <?=$onebook['title']?></a>
        &nbsp;<a href="deletebook.php?id=<?=$onebook['idbook']?>">supprimer</a>
        &nbsp;<a href="modifybook.php?id=<?=$onebook['idbook']?>">modifier</a><br>
<?php 
}
?>

<hr>
<h2>Ajouter un nouveau livre</h2>

<form action="formbook.php" method="POST">

    Titre :
    <input class="form-label" name="title" type="text"><br>


    Auteur :
    <select class="form-label" name="author" id="author" required>
        <option disabled selected>Choisissez un auteur</option>
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
        <option disabled selected>Choisissez une catégorie</option>
        <?php foreach ($category as $onecategory) { ?>
            <option value="<?= $onecategory['idcategory'] ?>"><?= $onecategory['genre'] ?>
            </option>
        <?php } ?>
    </select>

    <div class="form-label">Si la catégorie n'existe pas, 
       <a href="author.php">ajouter une nouvelle catégorie
       </a>avant de saisir votre nouveau livre.
    </div>

    Synopsis :<br>
    <textarea class="form-label" name="synopsis" type="text" 
    rows="10" cols="80"></textarea><br>
    

    <input type="submit" value="Valider">