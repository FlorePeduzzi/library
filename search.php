<?php
include "header.php";
?>
<div class="allmodifycategory">
    <div class="modifycategory">
        <?php

        $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');


        $statement = $pdo->prepare("SELECT * FROM author");
        $statement->execute();
        $author = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement = $pdo->prepare("SELECT * FROM category");
        $statement->execute();
        $category = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (empty($_GET['search'])) {
            header("location:book.php");
        } else if (isset($_GET['search'])) {
            $search = htmlentities($_GET['search']);

            $pdo = new PDO('mysql:host=localhost;dbname=library', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $pdo->prepare("SELECT * FROM book WHERE title LIKE :search");
            $statement->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $statement->execute();

            $book = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($book) > 0) {
                echo "<h5>Résultats de la recherche pour '$search' : </h5>";
                foreach ($book as $onebook) { ?>
                    <br>
                    <?php foreach ($book as $onebook) { ?>
                        <div class="imgsearch">
                            <img src=<?= $onebook['cover'] ?> class="card-img-top" style="max-width: 200px" ;>
                        </div>
                        <tr><br>
                            <td><a href="detailbook.php?id=<?= $onebook['idbook'] ?>">
                                    <?= $onebook['title'] ?></a></td>
                            <td>
                            <?php
                            foreach ($author as $oneauthor) {
                                if ($oneauthor['idauthor'] === $onebook['author_idauthor']) {
                                    echo $oneauthor['name'];
                                    break;
                                }
                            }
                        }
                            ?>
                <?php }
            } else {
                echo "Aucun résultat trouvé pour '$search'.";
            }
        } else {
            echo "Veuillez saisir un terme de recherche.";
        }
                ?>
    </div>
</div>