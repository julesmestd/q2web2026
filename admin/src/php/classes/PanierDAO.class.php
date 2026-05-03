<?php
class PanierDAO
{
    private PDO $_cnx;

    public function __construct(PDO $cnx)
    {
        $this->_cnx = $cnx;
    }

    public function ajouterArticle(int $id_client, int $id_article)
    {
        $query = "SELECT ajout_panier(:id_client, :id_article) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client);
            $stmt->bindValue(':id_article', $id_article);
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


    public function getPanier(int $id_client)
    {
        $query = "SELECT * FROM get_panier(:id_client)";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$data) return null;
            return $data;
        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }

    public function effacerArticle(int $id_client, int $id_article)
    {
        $query = "SELECT effacer_panier(:id_client, :id_article) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client);
            $stmt->bindValue(':id_article', $id_article);
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

    public function updateQuantite(int $id_client, int $id_article, int $quantite)
    {
        $query = "SELECT update_quantite_panier(:id_client, :id_article, :quantite) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client);
            $stmt->bindValue(':id_article', $id_article);
            $stmt->bindValue(':quantite', $quantite);
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