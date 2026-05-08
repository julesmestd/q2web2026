<?php
if (isset($_GET['submit'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (!empty($email) && !empty($password)) {
        $clientDAO = new ClientDAO($cnx);
        $client = $clientDAO->getClient($email, $password);
        if ($client != null) {
            $_SESSION['client'] = $client;


            if (!empty($_SESSION['panier'])) {
                $panierDAO = new PanierDAO($cnx);
                foreach ($_SESSION['panier'] as $id_article => $quantite) {
                    for ($i = 0; $i < $quantite; $i++) {
                        $panierDAO->ajouterArticle((int)$client->id_client, $id_article);
                    }
                }
                unset($_SESSION['panier']);
            }


            $_SESSION['page'] = "accueil.php";
            header("location: index_.php?page=accueil.php");
            exit();
        } else {
            print "<br>Email ou mot de passe incorrect<br>";
        }
    }
}
?>

<div class="form-container">
    <h2 class="form-titre">Connexion</h2>
    <form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div class="form-groupe">
            <label class="form-label-custom">Email</label>
            <input type="email" class="form-input" name="email" id="email">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Mot de passe</label>
            <input type="password" class="form-input" name="password" id="password">
        </div>
        <button type="submit" class="btn-formulaire" name="submit">Se connecter</button>
    </form>
    <p class="form-lien">Pas encore de compte ? <a href="index_.php?page=compte.php">Créer un compte</a></p>
    <p class="form-lien"><a href="admin/index_.php?page=login.php">Connexion admin</a></p>
</div>
