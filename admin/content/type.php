<h>Gestion des catégories</h>
<?php
$types = new TypeDAO($cnx);
$liste = $types->getAllTypes();

print $liste[1]->nom_type;
foreach ($liste as $t) {
    print"<br>- " . $t->nom_type . "(identifiant : " . $t->id_type . ")";
}

?>
<pre>
    <?php
    var_dump($liste);
    ?>
    ?>
</pre>
