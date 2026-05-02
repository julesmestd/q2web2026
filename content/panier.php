<?php
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] == 'ajouter') {
        if (!isset($_SESSION['client'])) {
            if (!isset($_SESSION['panier'])) $_SESSION['panier'] = [];
            if (isset($_SESSION['panier'][$id])) {
                $_SESSION['panier'][$id]++;
            } else {
                $_SESSION['panier'][$id] = 1;
            }
        } else {
            $panierDAO = new PanierDAO($cnx);
            $panierDAO->ajouterArticle((int)$_SESSION['client']->id_client, $id);
        }
        header("location: index_.php?page=panier.php");
        exit();
    }

    if ($_GET['action'] == 'supprimer') {
        if (!isset($_SESSION['client'])) {
            unset($_SESSION['panier'][$id]);
        } else {
            $panierDAO = new PanierDAO($cnx);
            $panierDAO->effacerArticle((int)$_SESSION['client']->id_client, $id);
        }
        header("location: index_.php?page=panier.php");
        exit();
    }
}
?>

<div class="container mt-4">
    <h2>Mon panier</h2>

    <?php if (!isset($_SESSION['client'])): ?>
        <?php if (empty($_SESSION['panier'])): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                <tr><th>Article</th><th>Quantité</th><th>Prix</th><th>Supprimer</th></tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                $articles = new ArticleTypeDAO($cnx);
                $data = $articles->getVueArticles();
                foreach ($_SESSION['panier'] as $id_article => $quantite):
                    $art = current(array_filter($data, fn($a) => $a->id_article == $id_article));
                    $sous_total = $art->prix * $quantite;
                    $total += $sous_total;
                    ?>
                    <tr>
                        <td><?= $art->nom_article ?></td>
                        <td><?= $quantite ?></td>
                        <td><?= number_format($sous_total, 2) ?>€</td>
                        <td>
                            <a href="index_.php?page=panier.php&action=supprimer&id=<?= $id_article ?>"
                               class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total : <?= number_format($total, 2) ?>€</strong></p>
            <a href="index_.php?page=login_client.php" class="btn btn-primary">Passer commande</a>
        <?php endif; ?>

    <?php else: ?>
        <?php
        $panierDAO = new PanierDAO($cnx);
        $lignes = $panierDAO->getPanier((int)$_SESSION['client']->id_client);
        ?>
        <?php if (!$lignes): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                <tr><th>Article</th><th>Quantité</th><th>Prix</th><th>Supprimer</th></tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                foreach ($lignes as $ligne):
                    $sous_total = $ligne['prix'] * $ligne['quantite'];
                    $total += $sous_total;
                    ?>
                    <tr>
                        <td><?= $ligne['nom_article'] ?></td>
                        <td><?= $ligne['quantite'] ?></td>
                        <td><?= number_format($sous_total, 2) ?>€</td>
                        <td>
                            <a href="index_.php?page=panier.php&action=supprimer&id=<?= $ligne['id_article'] ?>"
                               class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total : <?= number_format($total, 2) ?>€</strong></p>
            <a href="index_.php?page=commande.php" class="btn btn-primary">Passer commande</a>
        <?php endif; ?>
    <?php endif; ?>

    <a href="index_.php?page=accueil.php" class="btn btn-secondary mt-2">Continuer mes achats</a>
</div>