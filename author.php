<?php

include "header.php";


$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
$statement = $pdo->prepare("SELECT * FROM author");
$statement->execute();
$author = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<body>
    <h1 class="text-center mt-5">Liste des auteurs</h1>
    <a href="add_author.php" class="btn btn-outline-secondary" style="margin-left:30px;">Ajouter un nouvel auteur</a>

    <div class="containerbooks">
        <div class="row">
            <?php foreach ($author as $oneauthor) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card" style="height: 100%;">
                        <img src="<?= $oneauthor['picture'] ?>" class="card-img-top" style="object-fit: contain; height: 200px; margin-top:15px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><a href="detailauthor.php?id=<?= $oneauthor['idauthor'] ?>"><?= $oneauthor['name'] ?></a></h5>
                            <p class="card-text">
                            <div>
                                <a href="deleteauthor.php?id=<?= $oneauthor['idauthor'] ?>" class="btn btn-outline-secondary">Supprimer</a>
                                <a href="modifyauthor.php?id=<?= $oneauthor['idauthor'] ?>" class="btn btn-outline-secondary">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>