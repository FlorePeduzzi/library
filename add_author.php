
    <?php

    include "header.php";


    $pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');
    $statement = $pdo->query("select * from author");
    $author = $statement->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="allauteurs">
        <div class="auteurs">
            <h2 class="text-center mt-5">Ajouter un nouvel auteur</h2>
            <div class="container mt-5">
                <form action="formauthor.php" method="POST">
                <label for="nom" name="nom" class="form-label">Nom : </label>
                   <input type="text" name="nom" class="form-control"><br>

                    <div class="mb-3">
                        <br><label for="bio" name="bio" class="form-label">Bio : </label>
                        <textarea class="form-control" name="bio" id="bio" rows="10" cols="80"></textarea><br>

                        <input type="submit" value="Valider" class="btn btn-outline-secondary">
                    </div>
                </form>
            </div>
        </div>
    </div>