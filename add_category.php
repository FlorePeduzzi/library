<?php

include "header.php";

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement = $pdo->query("select * from category");
$category = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="allcategories">
    <div class="category">


        <h2 class="text-center mt-5">Ajouter une nouvelle catégorie</h2>
        <div class="container mt-5">
            <form action="formcategory.php" method="POST">
                <label for="genre" name="genre" class="form-label">Genre : </label>
                <input type="text" name="genre" class="form-control"><br>
                <input type="submit" value="Valider" class="btn btn-outline-secondary">
            </form>
        </div>
    </div>
</div>