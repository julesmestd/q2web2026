<?php
class Connexion
{
    //méthode statique dont la classe ne nécessite pas d'instanciation
    public static function getInstance($dsn, $user,$pass){
        try{
            $pdo = new PDO($dsn,$user,$pass);
            //var_dump($pdo);
            return $pdo;
        }catch(PDOException $e){
            print "Erreur : ".$e->getMessage();
        }
    }

}