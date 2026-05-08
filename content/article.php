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
        <div class="col-md-5 text-center">
            <img src="admin/assets/images/<?= $art->image ?>"
                 alt="<?= $art->nom_article ?>"
                 class="img-fluid"
                 style="max-height:400px; object-fit:contain;">
        </div>
        <div class="col-md-7">
            <span class="badge bg-warning text-dark mb-2"><?= $art->nom_type ?></span>
            <h2><?= $art->nom_article ?></h2>
            <p class="text-muted"><?= $art->description ?></p>
            <h4><?= number_format($art->prix, 2) ?>€</h4>
            <a href="index_.php?page=panier.php&action=ajouter&id=<?= $art->id_article ?>"
               class="btn btn-primary me-2">Ajouter au panier</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>