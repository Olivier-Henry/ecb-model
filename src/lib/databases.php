<?php

function getPDO() {
    $dsn = "mysql: host=" . DB_HOST . ";dbname=" . DB_NAME;
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
