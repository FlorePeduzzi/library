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

if ($count ==1 ) {
    $_SESSION["user"] = $login;
    header("location:book.php");
    exit;
} else {
    echo "Erreur lors de la saisie des informations.";
}


