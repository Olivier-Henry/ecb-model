<?php

function getPDO() {
    $dsn = "mysql: host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
    return $pdo;
}

function checkLogin($login, $password) {
    $pdo = getPDO();
    $sql = "SELECT EXISTS(SELECT * FROM clients WHERE email=? AND password=?) as ok";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $login,
        sha1($password)
    ));
    $rs = $stmt->fetch();

    return $rs['ok'];
}

/**
 * 
 * @return ResultSet of vue_catalogue
 */
function getCatalogue() {
    $pdo = getPDO();
    $sql = "SELECT * FROM vue_catalogue";
    $rs = $pdo->query($sql);

    return $rs;
}

/**
 * 
 * @param type $login as nom du client
 * @return Integer id du client
 */
function getClientInfo($login) {
    $pdo = getPDO();
    $sql = "SELECT id FROM clients WHERE email=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($login));

    $rs = $stmt->fetch();

    return $rs['id'];
}

/**
 * 
 * @param int $id du produit
 * @return Bool
 */
function checkProduitPanier($id) {
    $pdo = getPDO();
    $sql = "SELECT EXISTS(SELECT * FROM panier WHERE produit_id=?) as ok";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $id,
    ));
    $rs = $stmt->fetch();

    return $rs['ok'];
}

function ajoutPanier($idProduit, $idClient, $qt = 1) {
    $pdo = getPDO();
    $sql = "INSERT INTO panier(produit_id,client_id,qt)"
            . " VALUES "
            . "(:produitId, :clientId, :qt)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        'produitId' => $idProduit,
        'clientId' => $idClient,
        'qt' => $qt
    ));
}

function ajoutQuantitePanier($idProduit, $idClient, $qt = 1) {
    $pdo = getPDO();
    $sql = "UPDATE panier SET "
            . "produit_id=:produitId,"
            . "client_id=:clientId,"
            . "qt=(qt+:qt)"
            . " WHERE produit_id=:produitId AND "
            . "client_id=:clientId";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        'produitId' => $idProduit,
        'clientId' => $idClient,
        'qt' => $qt
    ));
}

/**
 * Récuperation d'un Rs des totaux pour le panier
 * @param type $id
 * @return Recorset
 */
function getTotauxPanier($id) {
    $pdo = getPDO();
    $sql = "SELECT SUM(qt) as qt_articles, sum(qt*prix) as tot_prix FROM panier AS p "
            . "INNER JOIN livres AS l "
            . "ON p.produit_id=l.id "
            . "WHERE client_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $id
    ));
    return $stmt->fetch();
}

/**
 * Ajout d'un nouveau genre
 * @param String $genre
 */
function ajouterGenre($genre) {
    $pdo = getPDO();
    $sql = "INSERT INTO genres(genre)"
            . " VALUES "
            . "(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $genre
    ));
}

function checkGenre($genre) {
    $pdo = getPDO();
    $sql = "SELECT EXISTS(SELECT * FROM genres WHERE genre=?) as ok";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $genre,
    ));
    $rs = $stmt->fetch();
    return $rs['ok'];
}

/**
 * Ajout d'un nouvel auteur
 * @param String $nom
 * @param String $prenom
 */
function ajouterAuteur($nom, $prenom) {
    $pdo = getPDO();
    $sql = "INSERT INTO auteurs(nom, prenom)"
            . " VALUES "
            . "(:nom, :prenom)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        'nom' => $nom,
        'prenom' => $prenom
    ));
}

/**
 * Verification qu'un auteur existe
 * @param String $nom
 * @param String $prenom
 * @return Boolean
 */
function checkAuteur($nom, $prenom) {
    $pdo = getPDO();
    $sql = "SELECT EXISTS(SELECT * FROM auteurs WHERE nom=? and prenom=?) as ok";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $nom,
        $prenom
    ));
    $rs = $stmt->fetch();
    return $rs['ok'];
}

/**
 * Ajout d'un editeur
 * @param String $nom
 */
function ajouterEditeur($nom) {
    $pdo = getPDO();
    $sql = "INSERT INTO editeurs(nom)"
            . " VALUES "
            . "(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $nom
    ));
}

/**
 * Verification de l'existence d'un editeur
 * @param string $nom
 * @return boolean
 */
function checkEditeur($nom) {
    $pdo = getPDO();
    $sql = "SELECT EXISTS(SELECT * FROM editeurs WHERE nom=?) as ok";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        $nom
    ));
    $rs = $stmt->fetch();
    return $rs['ok'];
}

/**
 * Recupère un array pour générer des options
 * @param String $nomTable
 * @param mixed $nomColonnes
 * @return array
 */
function getOptionsValues($nomTable, $nomColonnes) {
    $select = 'id';
    if (is_array($nomColonnes)) {
        $select .= ",CONCAT_WS(' '";
        foreach ($nomColonnes as $value) {
            $select .= ','.$value;
        }
        $select .= ') as value';
    } else {
      $select .= ','.$nomColonnes.' as value';  
    }
    
    $pdo = getPDO();
    $sql = "SELECT $select FROM $nomTable";  
    $rs = $pdo->query($sql);   
    return $rs;
}
