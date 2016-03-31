<?php

/**
 * Implémentation du Pattern DAO => Data Access Object
 */
class DAOClient implements IDAO {

    /**
     *
     * @var PDO
     */
    private $pdo;

    /**
     * Constructeur avec injection de l'objet de connexion à la BDD
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Efface un enregistrement en fonction de la clef primaire
     * @param int $pk
     */
    public function deleteByPk($pk) {
        $sql = "DELETE FROM clients WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $pk
        ));
    }

    public function exist($login, $password) {   
        $sql = "SELECT EXISTS(SELECT * FROM clients "
                . "WHERE email=? AND password=?) as ok";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $login,
            sha1($password)
        ));
        $rs = $stmt->fetch();

        return $rs['ok'];
    }

    /**
     * Retourne un résultat en fonction d'un tableau associatif
     * @param array $data
     * @return recorset
     */
    public function find(array $data) {
        $sql = "SELECT * FROM clients";
        $where = array();
        foreach ($data as $key => $value) {
            array_push($where, "$key=:$key");
        }
        if (count($where) > 0) {
            $sql .= " WHERE ";
            $sql .= implode(" AND ", $where);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    /**
     * Retourne un Recorset de toutes les données de la table
     * @return Recordset
     */
    public function findAll() {
        $sql = "SELECT * FROM clients";
        $rs = $this->pdo->query($sql)->fetchAll();
        return $rs;
    }

    /**
     * Retourne un résultat en fonction de la clef primaire
     * @param int $pk
     * @return Recordset
     */
    public function findOneByPk($pk) {
        $sql = "SELECT * FROM clients WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $pk
        ));
        $rs = $stmt->fetch();
        return $rs;
    }

    /**
     * Sauvegarde en appelant Insert ou Update 
     * en fonction du contexte
     * @param DTOClient $dto
     */
    public function save($dto) {
        if ($dto->getId() == null) {
            $this->insert($dto);
        } else {
            $this->update($dto);
        }
    }

    /**
     * Ajout du DTOClient à la BDD
     * @param DTOClient $dto
     */
    private function insert($dto) {
        $sql = "INSERT INTO clients (email, password) VALUES (?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            $dto->getEmail(),
            sha1($dto->getPlainPassword())
        ));
        $dto->setPassword(sha1($dto->getPlainPassword()));
        $dto->setPlainPassword(null);
        $dto->setId($this->pdo->lastInsertId());
    }

    /**
     * Mise à jour du DTO vers BDD
     * @param DTOClient $dto
     */
    private function update($dto) {
        $sql = "UPDATE clients SET email=:email, password=:password "
                . "WHERE id=:id";

        $data = array(
            'email' => $dto->getEmail(),
            'id' => $dto->getId(),
        );

        if (!empty($dto->getPlainPassword())) {
            $cryptedPass = sha1($dto->getPlainPassword());
            $data['password'] = $cryptedPass;
            $dto->setPassword($cryptedPass);
            $dto->setPlainPassword(null);
        } else {
            $data['password'] = $dto->getPassword();
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

}
