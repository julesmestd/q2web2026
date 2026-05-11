<?php
$articles = new ArticleTypeDAO($cnx);
$data = $articles->getVueArticles();

$idsAccueil = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$idsNouveautes = [7, 8, 9];

$selection = array_filter($data, fn($art) => in_array($art->id_article, $idsAccueil));
$nouveautes = array_filter($selection, fn($art) => in_array($art->id_article, $idsNouveautes));
$reste = array_filter($selection, fn($art) => !in_array($art->id_article, $idsNouveautes));

//$nouveautes devient un tableau avec indices 7,8,9
//inverse pour reste

$parType = [];
foreach ($reste as $art) {
    $parType[$art->nom_type][] = $art;
}
?>

<div class="container mt-4">
    <div class="section-categorie nouveautes mb-5">
        <h4>Nouveautés</h4>
        <div class="row">
            <?php foreach ($nouveautes as $art): ?>
                <div class="col-md-4 carte-article">
                    <a href="index_.php?page=article.php&id=<?= $art->id_article ?>">
                        <img src="admin/assets/images/<?= $art->image ?>" alt="<?= $art->nom_article ?>" class="img-fluid">
                        <p><?= $art->nom_article ?></p>
                    </a>
                    <p><strong><?= number_format($art->prix, 2) ?>€</strong></p>
                    <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>" class="btn btn-sm">Ajouter au panier</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php foreach ($parType as $nomType => $liste): ?>
        <div class="section-categorie mb-5">
            <h4><?= $nomType ?></h4>
            <div class="row">
                <?php foreach ($liste as $art): ?>
                    <div class="col-md-4 carte-article">
                        <a href="index_.php?page=article.php&id=<?= $art->id_article ?>">
                            <img src="admin/assets/images/<?= $art->image ?>" alt="<?= $art->nom_article ?>" class="img-fluid">
                            <p><?= $art->nom_article ?></p>
                        </a>
                        <p><strong><?= number_format($art->prix, 2) ?>€</strong></p>
                        <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>" class="btn btn-sm">Ajouter au panier</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>