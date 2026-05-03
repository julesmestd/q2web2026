<?php
require_once __DIR__ . '/../classes/Client.class.php';
session_start();
header('Content-Type: application/json');
require('../utils/all_includes.php');


$id_article = (int)$_GET['id_article'];

if (!isset($_SESSION['client'])) {
    unset($_SESSION['panier'][$id_article]);
    print json_encode(1);
} else {
    $panierDAO = new PanierDAO($cnx);
    $retour = $panierDAO->effacerArticle((int)$_SESSION['client']->id_client, $id_article);
    print json_encode($retour);
}