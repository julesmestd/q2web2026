<?php
header('Content-Type: application/json');
require('../utils/all_includes.php');
$types = new TypeDAO($cnx);
$retour = $types->effacerType((int)$_GET['id_type']);
print json_encode($retour);