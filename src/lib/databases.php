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
