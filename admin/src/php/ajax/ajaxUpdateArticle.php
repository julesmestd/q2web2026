<?php
header('Content-Type: application/json');
require('../utils/all_includes.php');
$art = new ArticleDAO($cnx);
$retour = $art->updateChampArticle($_GET['champ'], $_GET['nouveau'], (int)$_GET['id_article']);
print json_encode($retour);
