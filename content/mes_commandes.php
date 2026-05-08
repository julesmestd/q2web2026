<?php
if (!isset($_SESSION['client'])) {
    header("location: index_.php?page=login_client.php");
    exit();
}

$commandeDAO = new CommandeDAO($cnx);
$commandes = $commandeDAO->getCommandesClient((int)$_SESSION['client']->id_client);
?>

<div class="container mt-4">
    <h2 class="titre-page">Mes commandes</h2>

    <?php if (!$commandes): ?>
        <p>Vous n'avez pas encore de commandes.</p>
    <?php else: ?>
        <table class="tableau">
            <thead>
            <tr>
                <th>N° commande</th>
                <th>Date commande</th>
                <th>Date livraison</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= $commande->id_commande ?></td>
                    <td><?= $commande->date_commande ?></td>
                    <td><?= $commande->date_livraison ?></td>
                    <td><?= number_format($commande->prix_commande, 2) ?>€</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index_.php?page=accueil.php" class="btn-gris mt-3">Retour à l'accueil</a>
</div>