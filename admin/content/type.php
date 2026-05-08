<?php
require './src/php/utils/check_connexion.php';

$types = new TypeDAO($cnx);

if (isset($_GET['submit'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (!empty($nom_type)) {
        $types->addType($nom_type);
    }
}

$liste = $types->getAllTypes();
?>

<div class="container mt-4">
    <h2 class="titre-page">Gestion des types</h2>

    <button class="btn-violet" id="inserer">+ Ajouter un type</button>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" id="ajout_nouveau">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="nom_type" placeholder="Nom du type">
            <button type="submit" class="btn-violet" name="submit">Ajouter</button>
        </div>
    </form>

    <table class="tableau">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($liste as $t): ?>
            <tr>
                <td><?= $t->id_type ?></td>
                <td><?= $t->nom_type ?></td>
                <td class="delete delete-type" data-id="<?= $t->id_type ?>">
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>