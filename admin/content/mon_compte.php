<?php
require './src/php/utils/check_connexion.php';
?>

<div class="form-container">
    <h2 class="form-titre">Mon compte</h2>
    <p class="form-label-custom"><strong>Nom :</strong> <?= $_SESSION['admin']->nom_admin ?></p>
    <a href="./index_.php?page=disconnect.php" class="btn-formulaire">Déconnexion</a>
    <a href="./index_.php?page=accueil.php" class="btn-formulaire-annuler">Retour</a>
</div>