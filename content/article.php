<?php
if (!isset($_GET['id'])) {
    header("location: index_.php?page=accueil.php");
    exit();
}

$id = (int)$_GET['id'];
$articles = new ArticleTypeDAO($cnx);
$data = $articles->getVueArticles();
$art = current(array_filter($data, fn($a) => $a->id_article == $id));

if (!$art) {
    header("location: index_.php?page=accueil.php");
    exit();
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-5 img-article-container">
            <img src="admin/assets/images/<?= $art->image ?>" alt="<?= $art->nom_article ?>" class="img-article">
        </div>
        <div class="col-md-7 detail-article">
            <span class="badge-type"><?= $art->nom_type ?></span>
            <h2 class="nom-article-detail"><?= $art->nom_article ?></h2>
            <p class="description-article"><?= $art->description ?></p>
            <p class="prix-article-detail"><?= number_format($art->prix, 2) ?>€</p>
            <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>" class="btn-panier me-2">Ajouter au panier</a>
            <a href="javascript:history.back()" class="btn-retour">Retour</a>
        </div>
    </div>
</div>