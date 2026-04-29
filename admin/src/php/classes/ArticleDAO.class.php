<?php
class ArticleDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function effacerArticle($id_article)
    {
        $query = "SELECT effacer_article(:id_article) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_article', $id_article);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "<br>Echec de la suppression " . $e->getMessage();
        }
    }

    public function updateChampArticle($champ, $nouveau, $id_article)
    {
        $query = "SELECT update_champ_article(:champ, :nouveau, :id_article) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':nouveau', $nouveau);
            $stmt->bindValue(':id_article', $id_article);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            return $data;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "<br>Echec de la mise à jour - " . $e->getMessage();
        }
    }

    public function ajoutArticle($nom, $stock, $prix, $description, $type, $image)
    {
        $query = "SELECT ajout_article(:nom, :stock, :prix, :description, :type, :image) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':stock', $stock);
            $stmt->bindValue(':prix', $prix);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':image', $image);
            $stmt->execute();
            $data = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            if (!$data) return null;
            return $data;
        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print "<br>Echec de l'insertion - " . $e->getMessage();
        }
    }
}
