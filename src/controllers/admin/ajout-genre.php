<?php

$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);
//var_dump($genre);
if (isset($genre) && $genre != '') {
    if (checkGenre($genre)) {
        setFlash("Ce genre existe déja !");
        $response = getResponse('admin/view-ajout-genre');
    } else {
        try {
            ajouterGenre($genre);
            setFlash("Le genre ".$genre." a été ajouté avec succès !");
            $response = getResponse('admin/view-ajout-genre');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
} else {
    $response = getResponse('admin/view-ajout-genre');
}
echo $response;


