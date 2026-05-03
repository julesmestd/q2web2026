<?php
if (!isset($_SESSION['client'])) {
    header("location: index_.php?page=login_client.php");
    exit();
}
?>

<div class="container mt-4" style="max-width:500px">
    <a href="index_.php?page=mes_commandes.php" class="btn btn-primary mt-3">Mes commandes</a>
    <h2>Mon compte</h2>
    <p><strong>Nom :</strong> <?= $_SESSION['client']->nom_client ?></p>
    <p><strong>Prénom :</strong> <?= $_SESSION['client']->prenom_client ?></p>
    <p><strong>Email :</strong> <?= $_SESSION['client']->email ?></p>
    <p><strong>Téléphone :</strong> <?= $_SESSION['client']->telephone ?></p>
    <a href="index_.php?page=disconnect.php" class="btn btn-danger mt-3">Déconnexion</a>
</div>
