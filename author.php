<?php

include "header.php";


$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement=$pdo->query("select * from author");
$author=$statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($author);
echo "</pre>";
?>

<hr>
<h1>Liste des auteurs</h1>

<?php

foreach ($author as $oneauthor){ ?>
    <a href="detailauthor.php?id=<?=$oneauthor['idauthor']?>">
        <?=$oneauthor['name']?>
        </a>&nbsp;<a href="deleteauthor.php?id=<?=$oneauthor['idauthor']?>">supprimer</a>
        &nbsp;<a href="modifyauthor.php?id=<?=$oneauthor['idauthor']?>">modifier</a><br>
<?php
}
?>

<hr>
<h2>Ajouter un nouvel auteur</h2>

<form action="formauthor.php" method="POST">
    Nom : <input type="text" name="nom">
    <input type="submit" value="Valider">
</form>
<hr>


