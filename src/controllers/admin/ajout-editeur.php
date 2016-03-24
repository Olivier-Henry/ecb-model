<?php

$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
if (isset($nom) && $nom != '') {
    if (checkEditeur($nom)) {
        setFlash("Cet éditeur existe déja !");
        $response = getResponse('admin/view-ajout-editeur');
    } else {
        try {
            ajouterEditeur($nom);
            setFlash("L'éditeur ".$nom." a été ajouté avec succès !");
            $response = getResponse('admin/view-ajout-editeur');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
} else {
    $response = getResponse('admin/view-ajout-editeur');
}
echo $response;


