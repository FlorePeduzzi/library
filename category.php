<?php

include "header.php";


$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement = $pdo->prepare("SELECT * FROM category");
$statement->execute();
$category = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
    <h1 class="text-center mt-5">Liste des catégories</h1>
    <a href="add_category.php" class="btn btn-outline-secondary" style="margin-left:30px;">Ajouter une nouvelle catégorie</a>

    <div class="containerbooks">
        <div class="row">
            <?php foreach ($category as $onecategory) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card" style="height: 100%;">
                        <img src="<?= $onecategory['illustration'] ?>" class="card-img-top" style="object-fit: contain; height: 200px; margin-top:15px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="detailcategory.php?id=<?= $onecategory['idcategory'] ?>"><?= $onecategory['genre'] ?></a></h5>
                            <p class="card-text">
                            </p>
                            <div>
                                <a href="deletecategory.php?id=<?= $onecategory['idcategory'] ?>" class="btn btn-outline-secondary">Supprimer</a>
                                <a href="modifycategory.php?id=<?= $onecategory['idcategory'] ?>" class="btn btn-outline-secondary">Modifier</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>