<?php
require './src/php/utils/check_connexion.php';

$art = new ArticleDAO($cnx);
if (isset($_GET['submit'])) {
    extract($_GET, EXTR_OVERWRITE);
    if ($nom_article != '' && $prix != '' && $stock != '' && $image != '' && $id_type != '' && $description != '') {
        $retour = $art->ajoutArticle($nom_article, $stock, $prix, $description, $id_type, $image);
        if ($retour == null) {
            print "<br><span>Echec de l'insertion</span>";
        }
    }
}

$types = new TypeDAO($cnx);
$type = $types->getAllTypes();

$articles = new ArticleTypeDAO($cnx);
$data = $articles->getVueArticles();
?>

<div class="container mt-4">
    <button class="btn-violet mb-3" id="inserer">+ Insérer un nouvel article</button>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" id="ajout_nouveau">
        <table class="tableau">
            <tr>
                <td><input type="text" class="form-control" name="nom_article" placeholder="Nom de l'article"></td>
                <td><input type="number" class="form-control" name="stock" placeholder="Stock"></td>
                <td><input type="number" step="0.01" class="form-control" name="prix" placeholder="Prix"></td>
                <td><textarea class="form-control" name="description" placeholder="Description"></textarea></td>
                <td>
                    <select class="form-select" name="id_type">
                        <option selected>Type</option>
                        <?php foreach ($type as $typ): ?>
                            <option value="<?= $typ->id_type ?>"><?= $typ->nom_type ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="image" placeholder="Image"></td>
                <td><input type="submit" name="submit" class="btn-violet" value="+"></td>
            </tr>
        </table>
    </form>

    <?php if ($data != null): ?>
        <p class="titre-page">Articles disponibles</p>
        <table class="tableau">
            <tr>
                <th>Id</th><th>Nom</th><th>Stock</th><th>Prix</th><th>Description</th><th>Type</th><th>Image</th><th>Suppr.</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td contenteditable="false" data-champ="id_article" id="<?= $row->id_article ?>"><?= $row->id_article ?></td>
                    <td contenteditable="true" data-champ="nom_article" id="<?= $row->id_article ?>"><?= $row->nom_article ?></td>
                    <td contenteditable="true" data-champ="stock" id="<?= $row->id_article ?>"><?= $row->stock ?></td>
                    <td contenteditable="true" data-champ="prix" id="<?= $row->id_article ?>"><?= $row->prix ?></td>
                    <td contenteditable="true" data-champ="description" id="<?= $row->id_article ?>"><?= $row->description ?></td>
                    <td data-champ="id_type" id="<?= $row->id_article ?>">
                        <select class="form-select form-select-sm selectType">
                            <option value="<?= $row->id_type ?>" selected><?= $row->nom_type ?></option>
                            <?php foreach ($type as $typ): ?>
                                <option value="<?= $typ->id_type ?>"><?= $typ->nom_type ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td contenteditable="true" data-champ="image" id="<?= $row->id_article ?>"><?= $row->image ?></td>
                    <td class="delete delete-article" data-id="<?= $row->id_article ?>">
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p class="message-vide">Pas encore d'articles</p>
    <?php endif; ?>
</div>
