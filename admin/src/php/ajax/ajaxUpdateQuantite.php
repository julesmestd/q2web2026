<?php
require_once __DIR__ . '/../classes/Client.class.php';
session_start();
header('Content-Type: application/json');
require('../utils/all_includes.php');

$id_article = (int)$_GET['id_article'];
$quantite = (int)$_GET['quantite'];

if (!isset($_SESSION['client'])) {
    if ($quantite <= 0) {
        unset($_SESSION['panier'][$id_article]);
    } else {
        $_SESSION['panier'][$id_article] = $quantite;
    }
    print json_encode(1);
} else {
    $panierDAO = new PanierDAO($cnx);
    if ($quantite <= 0) {
        $retour = $panierDAO->effacerArticle((int)$_SESSION['client']->id_client, $id_article);
    } else {
        $retour = $panierDAO->updateQuantite((int)$_SESSION['client']->id_client, $id_article, $quantite);
    }
    print json_encode($retour);
}