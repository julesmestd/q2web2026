<?php
if (isset($_GET['submit_client'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (!empty($email) && !empty($password) && !empty($nom) && !empty($prenom)
            && !empty($telephone) && !empty($cp) && !empty($ville) && !empty($nom_rue) && !empty($num_rue)) {
        $clientDAO = new ClientDAO($cnx);
        $retour = $clientDAO->addClient($nom, $prenom, $email, $password, $telephone, $cp, $ville, $nom_rue, $num_rue);
        //si tous les champs sont complétés on ajoute le client dans la bd
        if ($retour != null) {
            $clientDAO = new ClientDAO($cnx);
            $client = $clientDAO->getClient($email, $password);
            $_SESSION['client'] = $client;
            //on connecte le client à la session
            if (!empty($_SESSION['panier'])) {
                $panierDAO = new PanierDAO($cnx);
                foreach ($_SESSION['panier'] as $id_article => $quantite) {
                    for ($i = 0; $i < $quantite; $i++) {
                        $panierDAO->ajouterArticle((int)$client->id_client, $id_article);
                    }
                }
                //on ajoute au panier s'il y a quelque chose et on retire le panier de la session
                unset($_SESSION['panier']);

            }

            header("location: index_.php?page=accueil.php");
            exit();
        }

    }
}
?>

<div class="form-container form-container-large">
    <h2 class="form-titre">Créer un compte</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">

        <h5 class="form-section-titre">Informations personnelles</h5>

        <div class="form-groupe">
            <label class="form-label-custom">Email</label>
            <input type="email" class="form-input" name="email" id="email">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Mot de passe</label>
            <input type="password" class="form-input" name="password" id="password">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Nom</label>
            <input type="text" class="form-input" name="nom" id="nom">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Prénom</label>
            <input type="text" class="form-input" name="prenom" id="prenom">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Téléphone</label>
            <input type="text" class="form-input" name="telephone" id="telephone">
        </div>

        <h5 class="form-section-titre">Adresse</h5>

        <div class="form-groupe">
            <label class="form-label-custom">Numéro de rue</label>
            <input type="text" class="form-input" name="num_rue" id="num_rue">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Nom de la rue</label>
            <input type="text" class="form-input" name="nom_rue" id="nom_rue">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Code postal</label>
            <input type="number" class="form-input" name="cp" id="cp">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Ville</label>
            <input type="text" class="form-input" name="ville" id="ville">
        </div>

        <div class="form-boutons">
            <button type="submit" class="btn-formulaire" name="submit_client">Créer mon compte</button>
            <button type="reset" class="btn-formulaire-annuler">Annuler</button>
        </div>
    </form>
</div>