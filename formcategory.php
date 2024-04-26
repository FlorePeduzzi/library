<?php
$genre=$_POST['genre'];
var_dump($_POST);
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$check_statement = $pdo->prepare("SELECT COUNT(*) FROM category WHERE genre = :genre");
$check_statement->bindValue(':genre', $genre, \PDO::PARAM_STR);
$check_statement->execute();
$count = $check_statement->fetchColumn();

if ($count > 0) {
    echo "Cette catégorie existe déjà dans la bibliothèque";
    exit;  
}

$statement=$pdo->prepare("INSERT INTO category(genre) VALUES (:genre)");
$statement->bindValue(':genre',$genre, \PDO::PARAM_STR);
$statement->execute();
?>

<?php
$genre=$_POST['genre'];
$chaineGenre = strlen('genre');
if($chaineGenre >80)
    echo "Erreur le nombre de caractères correspondant au genre est trop long";
?>


Vous ajoutez la catégorie <?=$_POST['genre'];?>.

<?php
header("location:category.php");
?>




