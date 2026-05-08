<?php

require 'admin/src/php/utils/all_includes.php';
session_start();

?>
<!doctype html >
<html lang = "fr" >
<head>
    <title>Pokemon</title>
    <meta charSet="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="admin/assets/js/fonctionsJquery.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="admin/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/accueil.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="admin/assets/css/menu.css">
</head >
<body>
    <div id="wrapper">
        <header id="header">
            <?php
            if(file_exists('admin/src/php/utils/header.php')) {
                include ('admin/src/php/utils/header.php');
            }
            if(file_exists('admin/src/php/utils/public_menu.php')) {
                include ('admin/src/php/utils/public_menu.php');
            }
            ?>
        </header>
        <main id="main">
            <section id="contenu">
                <?php
                    if(!isset($_SESSION['page'])){
                        $_SESSION['page'] = "accueil.php";
                    }
                    if(isset($_GET["page"])){
                        $_SESSION['page']=$_GET["page"];
                    }
                    $path = "content/" . $_SESSION["page"];

                if(isset($path) && file_exists($path)){
                    include($path);
                }else{
                    include ("content/page404.php");
                }
                ?>
            </section>
        </main>

        <footer id="footer">
            <?php
            if(file_exists('admin/src/php/utils/footer.php')) {
                include ('admin/src/php/utils/footer.php');
            }
            ?>
        </footer>
    </div>
</body>
</html>


