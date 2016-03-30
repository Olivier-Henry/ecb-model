<?php

class DAOLivre implements IDAO {

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     * Contructeur avec ajout de la connexion
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Efface un livre en fonction de son id
     * @param int $pk
     */
    public function deleteByPk($pk) {
        $sql = "DELETE FROM Livres WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $pk
        ));
    }

 
    
    /**
     * Retourne un resultset en fonction d'un tableau associatif
     * @param array $data
     * @return Resultset
     */
    public function find(array $data) {
        $sql = "SELECT * FROM Livres";
        if (!empty($data)) {
            $where = array();
            foreach ($data as $key => $value) {
                array_push($where, "$key=:$key");
            }
            if (count($where) > 0) {
                $sql .= " WHERE ";
                $sql .= implode(" AND ", $where);
            }
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    /**
     * Retourne la liste de tous les livres
     * @return ResultSet
     */
    public function findAll() {
        $sql = "SELECT * FROM vue_catalogue";
        return $this->pdo->query($sql)->fetchAll();
    }

    /**
     * Retourne un livre en fonction de son id
     * @param int $pk
     * @return Resultset
     */
    public function findOneByPk($pk) {
        $sql = "SELECT * FROM vue_catalogue WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $pk
        ));
        return $stmt->fetch();
    }

    /**
     * Update ou insert un élément dans la DB 
     * @param DTOLivre $dto
     */
    public function save($dto) {
        if ($dto->getId() == null) {
            $this->insert($dto);
        } else {
            $this->update($dto);
        }
    }

    /**
     * Insertion d'un nouveau livre
     * @param DTOLivre $dto
     */
    private function insert($dto) {
        $sql = "INSERT INTO Livres(titre,prix,date_achat,editeur_id,"
                . " genre_id, auteur_id) "
                . "VALUES(:titre,:prix,:date_achat,:editeur_id,"
                . " :genre_id,:auteur_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'titre' => $dto->getTitre(),
            'prix' => $dto->getPrix(),
            'date_achat' => $dto->getDate_achat(),
            'editeur_id' => $dto->getEditeur_id(),
            'genre_id' => $dto->getGenre_id(),
            'auteur_id' => $dto->getAuteur_id()
        ));

        $dto->setId($this->pdo->lastInsertId());
    }

    /**
     * Mise à jour d'un enregistrement Livres
     * @param DTOLivre $dto
     */
    private function update($dto) {
        $sql = "UPDATE Livres SET "
                . "titre=:titre,"
                . "prix=:prix,"
                . "date_achat=:date_achat,"
                . "editeur_id=:editeur_id,"
                . "genre_id=:genre_id,"
                . "auteur_id=:auteur_id "
                . "WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'titre' => $dto->getTitre(),
            'prix' => $dto->getPrix(),
            'date_achat' => $dto->getDate_achat(),
            'editeur_id' => $dto->getEditeur_id(),
            'genre_id' => $dto->getGenre_id(),
            'auteur_id' => $dto->getAuteur_id()
        ));
        
    }

}
