<?php class AdminDAO
{
    private PDO $_cnx;

    public function __construct($cnx)
    {
        $this->_cnx = $cnx;
    }

    public function getAdmin($login, $password)
    { //!!!! lorsqu'une fct plpgsql retourne une table, cette fonction est semblable à une table // virtuelle --> l'appeler comme une table / vue $query = "select * from get_admin(:login,:password)"; try{ //Transaction + requête préparée //…


        $query = "select * from get_admin(:login,:password)";

        try {

            $this->_cnx->BeginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue('login', $login);
            $stmt->bindValue('password', $password);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->_cnx->commit();
            if (!$data) {
                return null;
            }

            if (!$data) {
                return null;
            }
            if ((int)$data['id_admin'] === -1 && $data['nom_admin'] === '' && (int)$data['statut'] === -1) {
                return null;
            }

            return new Admin(id_admin: (int)$data['id_admin'], nom_admin: $data['nom_admin'], statut: (int)$data['statut']);


        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print $e->getMessage();
        }
    }
}

