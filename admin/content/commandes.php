<?php
require './src/php/utils/check_connexion.php';

$commandeDAO = new CommandeDAO($cnx);
$commandes = $commandeDAO->getToutesCommandes();
?>

<div class="container mt-4">
    <h2>Toutes les commandes</h2>

    <?php if (!$commandes): ?>
        <p>Aucune commande pour le moment.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>N° commande</th>
                <th>Client</th>
                <th>Date commande</th>
                <th>Date livraison</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= $commande['id_commande'] ?></td>
                    <td><?= $commande['prenom_client'] ?> <?= $commande['nom_client'] ?></td>
                    <td><?= $commande['date_commande'] ?></td>
                    <td><?= $commande['date_livraison'] ?></td>
                    <td><?= number_format($commande['prix_commande'], 2) ?>€</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
