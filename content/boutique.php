<?php
$articles = new ArticleTypeDAO($cnx);
$data = $articles->getVueArticles();

$type = $_GET['type'] ?? null;
$recherche = $_GET['recherche'] ?? null;

if ($type) {
    $data = array_filter($data, fn($art) => strtolower($art->nom_type) === strtolower($type));
}
if ($recherche) {
    $data = array_filter($data, fn($art) =>
            str_contains(strtolower($art->nom_article), strtolower($recherche)) ||
            str_contains(strtolower($art->nom_type), strtolower($recherche))
    );
    if (empty($data)) {
        header("location: index_.php?page=page404.php");
        exit();
    }
}
?>

<div class="container mt-4">
    <h2 class="titre-boutique"><?= $type ? ucfirst($type) : 'Tous les articles' ?></h2>
    <div class="row">
        <?php foreach ($data as $art): ?>
            <div class="col-md-3 mb-4 carte-boutique">
                <a href="index_.php?page=article.php&id=<?= $art->id_article ?>">
                    <img src="admin/assets/images/<?= $art->image ?>" alt="<?= $art->nom_article ?>" class="img-boutique">
                    <p class="nom-article"><?= $art->nom_article ?></p>
                </a>
                <p class="prix-boutique"><?= number_format($art->prix, 2) ?>€</p>
                <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>" class="btn-panier">Ajouter au panier</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>