<?php
$articles = new ArticleTypeDAO($cnx);
$data = $articles->getVueArticles();

$idsAccueil = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$idsNouveautes = [7, 8, 9];

$selection = array_filter($data, fn($art) => in_array($art->id_article, $idsAccueil));

// Séparer nouveautés et reste
$nouveautes = array_filter($selection, fn($art) => in_array($art->id_article, $idsNouveautes));
$reste = array_filter($selection, fn($art) => !in_array($art->id_article, $idsNouveautes));

// Grouper le reste par type
$parType = [];
foreach ($reste as $art) {
    $parType[$art->nom_type][] = $art;
}
?>

<div class="container mt-4">
    <div class="mb-5">
        <h4>Nouveautés</h4>
        <hr>
        <div class="row">
            <?php foreach ($nouveautes as $art): ?>
                <div class="col-md-3 mb-4 text-center">
                    <img src="admin/assets/images/<?= $art->image ?>"
                         alt="<?= $art->nom_article ?>"
                         class="img-fluid"
                         style="max-height:150px; object-fit:contain;">
                    <p class="mt-2"><?= $art->nom_article ?></p>
                    <p><strong><?= number_format($art->prix, 2) ?>€</strong></p>
                    <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>"
                       class="btn btn-primary btn-sm">Ajouter au panier</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php foreach ($parType as $nomType => $liste): ?>
        <div class="mb-5">
            <h4><?= $nomType ?></h4>
            <hr>
            <div class="row">
                <?php foreach ($liste as $art): ?>
                    <div class="col-md-3 mb-4 text-center">
                        <img src="admin/assets/images/<?= $art->image ?>"
                             alt="<?= $art->nom_article ?>"
                             class="img-fluid"
                             style="max-height:150px; object-fit:contain;">
                        <p class="mt-2"><?= $art->nom_article ?></p>
                        <p><strong><?= number_format($art->prix, 2) ?>€</strong></p>
                        <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>"
                           class="btn btn-primary btn-sm">Ajouter au panier</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>