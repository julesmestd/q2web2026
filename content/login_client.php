<?php
if (isset($_GET['submit'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (!empty($email) && !empty($password)) {
        $clientDAO = new ClientDAO($cnx);
        $client = $clientDAO->getClient($email, $password);
        if ($client != null) {
            $_SESSION['client'] = $client;
            $_SESSION['page'] = "accueil.php";
            header("location: index_.php?page=accueil.php");
            exit();
        } else {
            print "<br>Email ou mot de passe incorrect<br>";
        }
    }
}
?>

<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="mb-3">
        <label class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
    <br>
    <a href="admin/index_.php?page=login.php">Connexion admin</a>
</form>
<p class="mt-3">
    Pas encore de compte ? <a href="index_.php?page=compte.php">Créer un compte</a>
</p>
