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
     * Retourne le nombre d'éléments de la dernière requête SQL
     * @return array
     */
    public function getNbLivres(){
        $sql = "SELECT FOUND_ROWS() as nb";
        return $this->pdo->query($sql)->fetch();   
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
     * Retourne des livres en fonction d'un tableau associatif
     * @param array $data
     * @return ResultSet
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
     * Recherche dans le catalogue
     * Si les paramètres sont vide retournera tous les résultats avec offset
     * @param array $data ordinal de noms de tables
     * @param string $recherche
     * @param int $nbLivresParPage
     * @param int $page
     * @return resultset
     */
    public function search(array $data = null, $recherche = null, $nbLivresParPage = null, $page = 1) {
      
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM vue_catalogue";
        if (!empty($data) && $recherche != null) {
            $where = array();
            foreach ($data as $key => $value) {
                $recherche = "%$recherche%";
                array_push($where, "$value LIKE ?");
                $data[$key] = $recherche;
            }
            if (count($data) > 0) {
                $sql .= " WHERE ";
                $sql .= implode(" OR ", $where);
            }
        }

        if ($nbLivresParPage != null) {
            $offset = ($page - 1) * $nbLivresParPage;
            $sql .= " LIMIT $nbLivresParPage OFFSET $offset";
        }
        echo $sql;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetchAll();
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
