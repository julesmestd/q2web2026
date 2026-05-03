<?php
if (isset($_GET['submit_client'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (!empty($email) && !empty($password) && !empty($nom) && !empty($prenom)
            && !empty($telephone) && !empty($cp) && !empty($ville) && !empty($nom_rue) && !empty($num_rue)) {
        $clientDAO = new ClientDAO($cnx);
        $retour = $clientDAO->addClient($nom, $prenom, $email, $password, $telephone, $cp, $ville, $nom_rue, $num_rue);
        if ($retour != null) {

            $clientDAO = new ClientDAO($cnx);
            $client = $clientDAO->getClient($email, $password);
            $_SESSION['client'] = $client;

            // Transférer le panier session en base
            if (!empty($_SESSION['panier'])) {
                $panierDAO = new PanierDAO($cnx);
                foreach ($_SESSION['panier'] as $id_article => $quantite) {
                    for ($i = 0; $i < $quantite; $i++) {
                        $panierDAO->ajouterArticle((int)$client->id_client, $id_article);
                    }
                }
                unset($_SESSION['panier']);
            }

            header("location: index_.php?page=accueil.php");
            exit();
        }

    }
}
?>

<div class="container">
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="get">

        <h5>Informations personnelles</h5>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom">
        </div>
        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom">
        </div>
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" class="form-control" name="telephone" id="telephone">
        </div>

        <h5 class="mt-4">Adresse</h5>

        <div class="mb-3">
            <label class="form-label">Numéro de rue</label>
            <input type="text" class="form-control" name="num_rue" id="num_rue">
        </div>
        <div class="mb-3">
            <label class="form-label">Nom de la rue</label>
            <input type="text" class="form-control" name="nom_rue" id="nom_rue">
        </div>
        <div class="mb-3">
            <label class="form-label">Code postal</label>
            <input type="number" class="form-control" name="cp" id="cp">
        </div>
        <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville" id="ville">
        </div>

        <button type="submit" class="btn btn-primary" name="submit_client">Créer mon compte</button>
        <button type="reset" class="btn btn-secondary">Annuler</button>
    </form>
</div>