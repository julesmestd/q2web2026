<?php
require './src/php/utils/check_connexion.php';
?>
<h2>Gestion des catégories de produits</h2>
<?php
$types = new TypeDAO($cnx);
$liste = $types->getAllTypes();
print $liste[1]->nom_type;
//--> boucler
foreach($liste as $t){
    print "<br>- ".$t->nom_type." (identifiant : ".$t->id_type.")";
}
?>
<pre>
    <?php
    //var_dump($liste);
    ?>
</pre>

