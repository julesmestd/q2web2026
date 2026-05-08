<?php
require './src/php/utils/check_connexion.php';
?>

<div class="form-container">
    <h2 class="titre-page">Bienvenue <?= $_SESSION['admin']->nom_admin ?> !</h2>
    <p class="message-vide">Utilisez le menu pour gérer le site.</p>
</div>
