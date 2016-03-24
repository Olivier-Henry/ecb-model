<?php

$idProduit = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$login = $_SESSION['login'];


try {
    //Récupération du client
    $idClient = getClientInfo($login);
    if(checkProduitPanier($idProduit)){
        ajoutQuantitePanier($idProduit, $idClient);
    }else{
        ajoutPanier($idProduit, $idClient);
    }
//Test de l'existence du produit

//Insertion
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

header("Location: /produit");




