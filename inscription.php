<?php

include "header.php";

?>

<div class="allmodifycategory">
    <div class="modifycategory">
        <h2 class="text-center mt-3">Inscription</h2>
        <div class="container mt-4">
            <form action="save_user.php" method="POST">
                <div class="mb-3">
                    <input class="form-control" type="text" placeholder="login" aria-label="login" name="login"><br>
                    <input class="form-control" type="text" placeholder="password" aria-label="password" name="password"><br>
                    <button class="btn btn-outline-secondary" type="submit">Valider</button>
            </form>
        </div>
    </div>