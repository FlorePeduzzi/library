<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');


$statement = $pdo->prepare("SELECT * FROM author WHERE idauthor = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$author = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifyauthor.php?id=<?= $id ?>" method="POST">
    <input name="name" type="text" value="<?=$author['name']?>">

    <input type="submit" value="Modifier">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['name'];
    
    $statement = $pdo->prepare("UPDATE author SET name = :name WHERE idauthor = :id");
    $statement->bindValue(':name', $nom, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        header("location:author.php");
    } else {
        echo "Erreur lors de la mise à jour de l'auteur.";
    }
}
?>