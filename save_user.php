<?php

include "header.php";

$login = $_POST['login'];
$password = $_POST['password'];
$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');


$check_statement = $pdo->prepare("SELECT COUNT(*) FROM user WHERE login = :login AND password = :password");
$check_statement->bindValue(':login', $login, \PDO::PARAM_STR);
$check_statement->bindValue(':password', $password, \PDO::PARAM_STR);
$check_statement->execute();
$count = $check_statement->fetchColumn();

if ($count > 0) {
    echo "Vous êtes déjà inscrit(e).";
    exit;  
}


$statement = $pdo->prepare("INSERT INTO user (login,password) VALUES (:login, :password)");
$statement->bindValue(':login', $login, PDO::PARAM_STR);
$statement->bindValue(':password', $password, PDO::PARAM_STR);

if ($statement->execute()) {
    echo "L'inscription a bien été effectuée.";
    exit;
} else {
    echo "Erreur lors de la saisie des informations.";
}

?>