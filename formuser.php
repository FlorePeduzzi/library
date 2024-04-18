<?php
$name=$_POST['nom'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement=$pdo->prepare("INSERT INTO user(name) VALUES (:name)");
$statement->bindValue(':name',$name, \PDO::PARAM_STR);
$statement->execute();


var_dump($_POST);
?>

<?php
$name=$_POST['nom'];
$chaineNom = strlen('nom');
if($chaineNom >80)
    echo "Erreur le nombre de caractères correspondant au nom de l'auteur est trop long";
?>

Vous ajoutez l'utilisateur <?=$_POST['nom'];?>.