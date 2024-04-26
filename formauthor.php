<?php
$name=$_POST['nom'];
$bio=$_POST['bio'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$check_statement = $pdo->prepare("SELECT COUNT(*) FROM author WHERE name = :name");
$check_statement->bindValue(':name', $name, \PDO::PARAM_STR);
$check_statement->execute();
$count = $check_statement->fetchColumn();

if ($count > 0) {
    echo "Cet auteur existe déjà dans la bibliothèque";
    exit;  
}

$statement=$pdo->prepare("INSERT INTO author(name, bio) VALUES (:name, :bio)");
$statement->bindValue(':name',$name, \PDO::PARAM_STR);
$statement->bindValue(':bio',$bio, \PDO::PARAM_STR);
$statement->execute();

?>
<?php
header("location:author.php");
?>