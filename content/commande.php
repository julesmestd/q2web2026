<?php
if (!isset($_SESSION['client'])) {
    header("location: index_.php?page=login_client.php");
    exit();
}

$panierDAO = new PanierDAO($cnx);
$lignes = $panierDAO->getPanier((int)$_SESSION['client']->id_client);

if (!$lignes) {
    header("location: index_.php?page=panier.php");
    exit();
}


$total = 0;
foreach ($lignes as $ligne) {
    $total += $ligne['prix'] * $ligne['quantite'];
}


if (isset($_GET['confirmer'])) {
    $commandeDAO = new CommandeDAO($cnx);
    $retour = $commandeDAO->ajoutCommande((int)$_SESSION['client']->id_client, $total);
    if ($retour != null) {
        header("location: index_.php?page=mes_commandes.php");
        exit();
    } else {
        print "<div class='alert alert-danger'>Echec de la commande.</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="titre-page">Récapitulatif de la commande</h2>
    <table class="tableau">
        <thead>
        <tr><th>Article</th><th>Quantité</th><th>Prix unitaire</th><th>Sous-total</th></tr>
        </thead>
        <tbody>
        <?php foreach ($lignes as $ligne): ?>
            <tr>
                <td><?= $ligne['nom_article'] ?></td>
                <td><?= $ligne['quantite'] ?></td>
                <td><?= number_format($ligne['prix'], 2) ?>€</td>
                <td><?= number_format($ligne['prix'] * $ligne['quantite'], 2) ?>€</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p><strong>Total : <?= number_format($total, 2) ?>€</strong></p>
    <a href="index_.php?page=commande.php&confirmer=1" class="btn-vert">Confirmer la commande</a>
    <a href="index_.php?page=panier.php" class="btn-gris">Retour au panier</a>
</div>
