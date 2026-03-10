<?php

if(isset($_GET['submit'])){
    extract($_GET,EXTR_OVERWRITE);
    if(!empty($login)&& !empty($password)){
        $admin=new AdminDAO($cnx);
        $adm=$admin->getAdmin($login,$password);
        $_SESSION['admin']=1;
        $_SESSION['page']='accueil.php';
        header("location:./index.php?page=accueil.php");
        exit();
    }
}

?>
<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <div class="mb-3">
            <label for="login" class="form-label">Login : </label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password : </label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>