<?php

include "header.php";


$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement=$pdo->query("select * from user");
$user=$statement->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($user);
echo "</pre>";
?>

<hr>
<h1>Liste des utilisateurs</h1>

<?php

foreach ($user as $oneuser){ ?>
    <a href="detailuser.php?id=<?=$oneuser['iduser']?>">
        <?=$oneuser['name']?>
        </a>&nbsp;<a href="deleteuser.php?id=<?=$oneuser['iduser']?>">supprimer</a>
        &nbsp;<a href="modifyuser.php?id=<?=$oneuser['iduser']?>">modifier</a><br>
<?php
}
?>

<hr>
<h2>Ajouter un nouvel utilisateur</h2>

<form action="formuser.php" method="POST">
    Nom : <input type="text" name="nom">
    <input type="submit" value="Valider">
</form>
<hr>