<?php
class ClientDAO
{
    private PDO $_cnx;

    public function __construct(PDO $cnx)
    {
        $this->_cnx = $cnx;
    }

    public function getClient($email, $password)
    {
        $query = "SELECT * FROM get_client(:email, :password)";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->_cnx->commit();

            if (!$data || (int)$data['id_client'] === -1) {
                return null;
            }
            return new Client(
                id_client:     (int)$data['id_client'],
                nom_client:    $data['nom_client'],
                prenom_client: $data['prenom_client'],
                email:         $data['email'],
                mot_de_passe:  $data['mot_de_passe'],
                telephone:     $data['telephone'],
                id_adresse:    (int)$data['id_adresse']
            );
        } catch (PDOException $e) {
            $this->_cnx->rollback();
            print $e->getMessage();
            return null;
        }
    }

    public function addClient($nom, $prenom, $email, $password, $telephone, $cp, $ville, $nom_rue, $num_rue)
    {
        $query = "SELECT ajout_client(:nom,:prenom,:email,:password,:telephone,:cp,:ville,:nom_rue,:num_rue) AS retour";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':telephone', $telephone);
            $stmt->bindValue(':cp', $cp);
            $stmt->bindValue(':ville', $ville);
            $stmt->bindValue(':nom_rue', $nom_rue);
            $stmt->bindValue(':num_rue', $num_rue);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_cnx->commit();

            if (!$retour || (int)$retour === -1) {
                return null;
            }
            return $retour;
        } catch (PDOException $e) {
            $this->_cnx->rollback();
            print $e->getMessage();
            return null;
        }
    }
}