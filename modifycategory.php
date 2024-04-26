<?php
include "header.php";

$id = $_GET['id'];

$pdo = new \PDO('mysql:host=localhost;dbname=library', 'root');

$statement = $pdo->prepare("SELECT * FROM category WHERE idcategory = :id");
$statement->bindValue(':id', $id, \PDO::PARAM_INT);
$statement->execute();

$category = $statement->fetch(PDO::FETCH_ASSOC);

?>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updates = [];
    $params = ['id' => $id];

    if (!empty($_POST['genre']) && $_POST['genre'] != $category['genre']) {
        $updates[] = "genre = :genre";
        $params['genre'] = $_POST['genre'];
    }


    if (!empty($_FILES['illustration']['name'])) {
        $newFilename = uniqid() . '_' . basename($_FILES['illustration']['name']);
        $dossierTempo = $_FILES['illustration']['tmp_name'];
        $dossierSite = 'uploads/' . $newFilename;
        if (move_uploaded_file($dossierTempo, $dossierSite)) {
            $updates[] = "illustration = :illustration";
            $params['illustration'] = $dossierSite;
        }
    }

    if (!empty($updates)) {
        $sql = "UPDATE category SET " . implode(', ', $updates) . " WHERE idcategory = :id";
        $statement = $pdo->prepare($sql);
        foreach ($params as $key => &$val) {
            $statement->bindParam($key, $val);
        }

        if ($statement->execute()) {
            header("location:category.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour de la catégorie.";
        }
    }
}
?>

<div class="allmodifycategory">
    <div class="modifycategory">
        <h2 class="text-center mt-3">Modifier la catégorie</h2>
        <div class="container mt-4">
            <form action="modifycategory.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="genre" class="form-label">Nom :</label>
                    <input name="genre" type="text" class="form-control" value="<?= $category['genre'] ?>">
                </div>


                <div class="mb-3">
                    <label for="uploads" class="form-label">Illustration :</label><br>
                    <img src="<?= $category['illustration'] ?>" style="max-width: 200px;"><br>
                    <br><input class="form-control" type="file" name="illustration" id="uploads"><br>

                    <button type="submit" class="btn btn-outline-secondary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>