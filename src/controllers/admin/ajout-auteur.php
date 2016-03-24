<?php

$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
if (isset($nom) && isset($prenom) && $nom != '' && $prenom != '') {
    if (checkAuteur($nom, $prenom)) {
        setFlash("Cet auteur existe déja !");
        $response = getResponse('admin/view-ajout-auteur');
    } else {
        try {
            ajouterAuteur($nom, $prenom);
            setFlash("L'auteur $nom $prenom a été ajouté avec succès !");
            $response = getResponse('admin/view-ajout-auteur');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
} else {
    $response = getResponse('admin/view-ajout-auteur');
}
echo $response;
