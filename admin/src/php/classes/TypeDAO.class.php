<?php

class TypeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getAllTypes()
    {
        $sql = "SELECT * FROM type";
        try {
            $stmt = $this->_cnx->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {
                return new Type(
                    id_type: (int)$d['id_type'],
                    nom_type: (string)$d['nom_type']
                );
            }, $data);
        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }

    public function addType(string $nom_type)
    {
        $query = "SELECT ajout_type(:nom_type) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindParam(":nom_type", $nom_type);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_cnx->rollback();
            print $e->getMessage();
            return null;
        }
    }

    public function effacerType(int $id_type)
    {
        $query = "SELECT effacer_type(:id_type) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(":id_type", $id_type);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_cnx->rollback();
            print $e->getMessage();
            return null;
        }
    }


}