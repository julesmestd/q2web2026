<?php

//Traitement du formulaire
if(isset($_GET['submit'])) {
    extract($_GET,EXTR_OVERWRITE);
    if(!empty($login) && !empty($password)){
        $admin = new AdminDAO($cnx);
        $adm = $admin->getAdmin($login,$password);
        //var_dump($adm);
        if($adm != null) {
            $_SESSION['admin'] = $adm;
            $_SESSION['page'] = "accueil.php";
            header("location:./index_.php?page=accueil.php");
            exit();
        } else {
            print "<br>Accès réservé aux administrateurs<br>";
        }
    }
}


?>

<div class="form-container">
    <h2 class="form-titre">Administration</h2>
    <form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div class="form-groupe">
            <label class="form-label-custom">Login</label>
            <input type="text" class="form-input" id="login" name="login">
        </div>
        <div class="form-groupe">
            <label class="form-label-custom">Mot de passe</label>
            <input type="password" class="form-input" id="password" name="password">
        </div>
        <button type="submit" class="btn-formulaire" name="submit">Se connecter</button>
    </form>
</div>

