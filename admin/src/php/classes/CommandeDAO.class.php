<?php
class CommandeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $cnx)
    {
        $this->_cnx = $cnx;
    }

    public function ajoutCommande(int $id_client, float $prix_commande)
    {
        $query = "SELECT ajout_commande(:id_client, :prix_commande) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client);
            $stmt->bindValue(':prix_commande', $prix_commande);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_cnx->commit();
            if (!$retour || (int)$retour === -1) return null;
            return $retour;
        } catch (PDOException $e) {
            $this->_cnx->rollback();
            print $e->getMessage();
            return null;
        }
    }

    public function getCommandesClient(int $id_client)
    {
        $query = "SELECT * FROM get_commandes_client(:id_client)";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_client', $id_client);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$data) return null;
            return array_map(function ($d) use ($id_client) {
                return new Commande(
                    id_commande:   (int)$d['id_commande'],
                    date_commande: $d['date_commande'],
                    date_livraison: $d['date_livraison'],
                    prix_commande: (float)$d['prix_commande'],
                    id_client:     $id_client
                );
            }, $data);
        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }

    public function getToutesCommandes()
    {
        $query = "SELECT * FROM get_toutes_commandes()";
        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$data) return null;
            return $data;
        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }
}
