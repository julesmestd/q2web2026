<?php

session_start();
include('src/php/utils/all_includes.php');


?>

<!doctype html>
<html lang="fr">
<head>
    <title>Boulangerie</title>
    <meta charset="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
<div id ="wrapper">
    <header id = "header">
        <?php
        if(file_exists('src/php/utils/admin_menu.php')){
            include('src/php/utils/admin_menu.php');
        }
        ?>
    </header>
    <main id="main">
        <?php
        if(!isset($_SESSION['page'])){
            $_SESSION['page']="accueil.php";
        }
        if(isset($_GET['page'])){
            $_SESSION['page']=$_GET['page'];
        }
        $path="content/".$_SESSION['page'];
        if(file_exists($path)){
            include($path);
        }else{
            include("content/page404.php");
        }
        ?>
    </main>
    <footer id="footer">
        <p>footer</p>
    </footer>
</div>
</body>
</html>


