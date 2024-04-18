<?php

include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement=$pdo->query("select * from category");
$category=$statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($category);
echo "</pre>";

?>

<hr>
<h1>Liste des catégories</h1>

<?php

foreach ($category as $onecategory){ ?>
    <a href="detailcategory.php?id=<?=$onecategory['idcategory']?>">
        <?=$onecategory['genre']?>
    </a>&nbsp;<a href="deletecategory.php?id=<?=$onecategory['idcategory']?>">supprimer</a>
    &nbsp;<a href="modifycategory.php?id=<?=$onecategory['idcategory']?>">modifier</a><br>
    <?php 
}
?>

<hr>
<h2>Ajouter une nouvelle catégorie</h2>

<form action="formcategory.php" method="POST">
    Genre : <input type="text" name="genre">
    <input type="submit" value="Valider">
</form>
<hr>




