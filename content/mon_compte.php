<?php
if (!isset($_SESSION['client'])) {
    header("location: index_.php?page=login_client.php");
    exit();
}
?>

<div class="form-container">
    <h2 class="form-titre">Mon compte</h2>
    <p class="form-label-custom"><strong>Nom :</strong> <?= $_SESSION['client']->nom_client ?></p>
    <p class="form-label-custom"><strong>Prénom :</strong> <?= $_SESSION['client']->prenom_client ?></p>
    <p class="form-label-custom"><strong>Email :</strong> <?= $_SESSION['client']->email ?></p>
    <p class="form-label-custom"><strong>Téléphone :</strong> <?= $_SESSION['client']->telephone ?></p>
    <a href="index_.php?page=mes_commandes.php" class="btn-formulaire">Mes commandes</a>
    <a href="index_.php?page=disconnect.php" class="btn-formulaire-annuler">Déconnexion</a>
</div>
