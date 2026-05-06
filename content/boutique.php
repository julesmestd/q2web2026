<?php
$articles = new ArticleTypeDAO($cnx);
$data = $articles->getVueArticles();

$type = $_GET['type'] ?? null;

if ($type) {
    $data = array_filter($data, fn($art) => strtolower($art->nom_type) === strtolower($type));
}
?>

<div class="container mt-4">
    <h2><?= $type ? ucfirst($type) . 's' : 'Tous les articles' ?></h2>
    <div class="row">
        <?php foreach ($data as $art): ?>
            <div class="col-md-3 mb-4 text-center">
                <a href="index_.php?page=article.php&id=<?= $art->id_article ?>">
                    <img src="admin/assets/images/<?= $art->image ?>"
                         alt="<?= $art->nom_article ?>"
                         class="img-fluid"
                         style="max-height:150px; object-fit:contain;">
                    <p class="mt-2"><?= $art->nom_article ?></p>
                </a>
                <p><strong><?= number_format($art->prix, 2) ?>€</strong></p>
                <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>"
                   class="btn btn-primary btn-sm">Ajouter au panier</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>