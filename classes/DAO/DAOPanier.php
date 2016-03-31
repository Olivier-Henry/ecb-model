<?php

class DAOPanier implements IDAO {

    /**
     *
     * @var PDO
     */
    private $pdo;

    public function deleteByPk($clientId, $produitId) {
        $sql = "DELETE FROM panier WHERE client_id=? AND produit_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $clientId,
            $produitId
        ));
    }

    public function find(array $data) {
        
    }

    public function findAll() {
        $sql = "SELECT * FROM panier";
        $rs = $this->pdo->query($sql)->fetchAll();
        return $rs;
    }

    public function findOneByPk($pk) {
        
    }

    public function save($dto) {
        
    }

}
