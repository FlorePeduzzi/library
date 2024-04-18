<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');


$statement = $pdo->prepare("SELECT * FROM category WHERE idcategory = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$category = $statement->fetch(PDO::FETCH_ASSOC);

var_dump($id);
?>
<form action="modifycategory.php?id=<?= $id ?>" method="POST">
    <input name="genre" type="text" value="<?= $category['genre'] ?>">

    <input type="submit" value="Modifier">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $genre = $_POST['genre'];

    $statement = $pdo->prepare("UPDATE category SET genre = :genre WHERE idcategory = :id");
    $statement->bindValue(':genre', $genre, \PDO::PARAM_STR);
    $statement->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($statement->execute()) {
        header("location:category.php");
    } else {
        echo "Erreur lors de la mise à jour de la catégorie.";
    }  
}
?>

