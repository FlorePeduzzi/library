<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');


$statement = $pdo->prepare("SELECT * FROM user WHERE iduser = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifyuser.php?id=<?= $id ?>" method="POST">
    <input name="name" type="text" value="<?=$user['name']?>">

    <input type="submit" value="Modifier">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['name'];

    $statement = $pdo->prepare("UPDATE user SET name = :name WHERE iduser = :id");
    $statement->bindValue(':name', $nom, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        header("location:user.php");
    }
    else {
        echo "Erreur lors de la mise à jour de l'utilisateur.";
    }
} 
?>