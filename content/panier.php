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
        $retour = $_SERVER['HTTP_REFERER'] ?? 'index_.php?page=accueil.php';
        header("location: " . $retour);
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

    if ($_GET['action'] == 'modifier') {
        $quantite = (int)$_GET['quantite'];
        if (!isset($_SESSION['client'])) {
            $_SESSION['panier'][$id] = $quantite;
        } else {
            $panierDAO = new PanierDAO($cnx);
            $panierDAO->updateQuantite((int)$_SESSION['client']->id_client, $id, $quantite);
        }
        header("location: index_.php?page=panier.php");
        exit();
    }
}
?>

<div class="container mt-4">
    <h2 class="titre-page">Mon panier</h2>

    <?php if (!isset($_SESSION['client'])): ?>
        <?php if (empty($_SESSION['panier'])): ?>
            <p class="message-vide">Votre panier est vide.</p>
        <?php else: ?>
            <table class="tableau">
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
                    <tr data-id="<?= $id_article ?>" data-prix="<?= $art->prix ?>">
                        <td><?= $art->nom_article ?></td>
                        <td>
                            <button class="btn-quantite btn-moins" data-id="<?= $id_article ?>">-</button>
                            <span class="quantite"><?= $quantite ?></span>
                            <button class="btn-quantite btn-plus" data-id="<?= $id_article ?>">+</button>
                        </td>
                        <td class="prix-article"><?= number_format($sous_total, 2) ?>€</td>
                        <td class="delete" >
                            <a href="#" class="delete-panier" data-id="<?= $id_article ?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total-panier">Total : <span id="total"><?= number_format($total, 2) ?>€</span></p>
            <a href="index_.php?page=login_client.php" class="btn-violet">Passer commande</a>
        <?php endif; ?>

    <?php else: ?>
        <?php
        $panierDAO = new PanierDAO($cnx);
        $lignes = $panierDAO->getPanier((int)$_SESSION['client']->id_client);
        ?>
        <?php if (!$lignes): ?>
            <p class="message-vide">Votre panier est vide.</p>
        <?php else: ?>
            <table class="tableau">
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
                    <tr data-id="<?= $ligne['id_article'] ?>" data-prix="<?= $ligne['prix'] ?>">
                        <td><?= $ligne['nom_article'] ?></td>
                        <td>
                            <button class="btn-quantite btn-moins" data-id="<?= $ligne['id_article'] ?>">-</button>
                            <span class="quantite"><?= $ligne['quantite'] ?></span>
                            <button class="btn-quantite btn-plus" data-id="<?= $ligne['id_article'] ?>">+</button>
                        </td>
                        <td class="prix-article"><?= number_format($sous_total, 2) ?>€</td>
                        <td class="delete" >
                            <a href="#" class="delete-panier" data-id="<?= $ligne['id_article'] ?>">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total-panier">Total : <span id="total"><?= number_format($total, 2) ?>€</span></p>
            <a href="index_.php?page=commande.php" class="btn-violet">Passer commande</a>
        <?php endif; ?>
    <?php endif; ?>

    <a href="javascript:history.back()" class="btn-gris mt-2">Continuer mes achats</a>
</div>