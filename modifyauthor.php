<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement = $pdo->prepare("SELECT * FROM author WHERE idauthor = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$author = $statement->fetch(PDO::FETCH_ASSOC);

?>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    $params = ['id' => $id];

    if (!empty($_POST['name']) && $_POST['name'] != $author['name']) {
        $updates[] = "name = :name";
        $params['name'] = $_POST['name'];
    }
    if (!empty($_POST['picture']) && $_POST['picture'] != $author['picture']) {
        $updates[] = "picture = :picture";
        $params['picture'] = $_POST['picture'];
    }

    if (!empty($_POST['bio']) && $_POST['bio'] != $author['bio']) {
        $updates[] = "bio = :bio";
        $params['bio'] = $_POST['bio'];
    }

    if (!empty($_FILES['picture']['name'])) {
        $newFilename = uniqid() . '_' . basename($_FILES['picture']['name']);
        $dossierTempo = $_FILES['picture']['tmp_name'];
        $dossierSite = 'uploads/' . $newFilename;
        if (move_uploaded_file($dossierTempo, $dossierSite)) {
            $updates[] = "picture = :picture";
            $params['picture'] = $dossierSite;
        }
    }

    if (!empty($updates)) {
        $sql = "UPDATE author SET " . implode(', ', $updates) . " WHERE idauthor = :id";
        $statement = $pdo->prepare($sql);
        foreach ($params as $key => &$val) {
            $statement->bindParam($key, $val);
        }

        if ($statement->execute()) {
            header("location:author.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour de la catégorie.";
        }
    }
}
?>

<div class="allmodify">
    <div class="modify">
        <h2 class="text-center mt-3">Modifier l'auteur</h2>
        <div class="container mt-4">
            <form action="modifyauthor.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom :</label>
                    <input name="name" type="text" class="form-control" value="<?= $author['name'] ?>">
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio :</label>
                    <textarea class="form-control" name="bio" id="bio" rows="5"><?= $author['bio'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="uploads" class="form-label">Photo :</label><br>
                    <img src="<?= $author['picture'] ?>" style="max-width: 200px;"><br>
                    <br><input class="form-control" type="file" name="picture" id="uploads"><br>

                    <button type="submit" class="btn btn-outline-secondary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>