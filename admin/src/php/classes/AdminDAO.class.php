<?php

class AdminDAO
{
    private PDO $_cnx;

    public function __construct($cnx)
    {
        $this->_cnx = $cnx;
    }

    public function getAdmin($login, $password)
    {
        $query = "select * from get_admin(:login,:password)";
        try {
            $this->_cnx->beginTransaction();
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->_cnx->commit();

            if (!$data) {
                return null;
            }

            return new Admin(
                id_admin:  (int)$data['id_admin'],
                nom_admin: $data['nom_admin']
            );

        } catch (PDOException $e) {
            $this->_cnx->rollBack();
            print $e->getMessage();
        }
    }
}