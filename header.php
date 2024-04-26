<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Library</title>
</head>
<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=library', 'root');
?>

<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="biblio.php">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="book.php">Livres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Auteurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Catégories</a>
                    </li>
                </ul>
                <div class="navdroite">
                    <form action="search.php" method="GET" class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Rechercher un livre" aria-label="search" name="search">
                        <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                    </form>
                </div>
                <div class="verticalline"></div>
                <div class="navdroite">
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo '<form action="deconnexion.php" class="d-flex">
                    <button class="btn btn-outline-secondary" type="submit">Déconnexion</button>
                </form>';
                    }
                    if (!isset($_SESSION["user"])) {
                        echo '<form action="connexion.php" class="d-flex">
                    <button class="btn btn-outline-secondary" type="submit">Connexion</button>
                </form>';
                    } ?>
                </div>
                <div class="usericon">
                    &nbsp&nbsp<i class="fa-solid fa-user"></i>&nbsp&nbsp&nbsp
                </div>
                <form action="inscription.php" class="d-flex">
                    <button class="btn btn-outline-secondary" type="submit">Inscription</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<?php

if (isset($_SESSION["user"])) {
    echo "Bonjour " . $_SESSION["user"].", vous êtes connecté(e)";
}
?>
</html>