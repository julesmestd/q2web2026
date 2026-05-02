<?php
require './src/php/utils/check_connexion.php';
?>

<div class="container mt-4" style="max-width:500px">
    <h2>Mon compte</h2>
    <p><strong>Nom :</strong> <?= $_SESSION['admin']->nom_admin ?></p>
    <a href="./index_.php?page=disconnect.php" class="btn btn-danger mt-3">Déconnexion</a>
</div>