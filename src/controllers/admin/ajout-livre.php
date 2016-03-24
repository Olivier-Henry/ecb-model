<?php
$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
$prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT);
$date = filter_input(INPUT_POST, 'date_achat', FILTER_SANITIZE_STRING);
$auteur = filter_input(INPUT_POST, 'auteur', FILTER_SANITIZE_NUMBER_INT);
$editeur = filter_input(INPUT_POST, 'editeur', FILTER_SANITIZE_NUMBER_INT);
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);


var_dump($_POST);
$auteurs = getOptionsValues('auteurs', array(
    'nom',
    'prenom'
));

$editeurs = getOptionsValues('editeurs', 'nom');
$genres = getOptionsValues('genres', 'genre');

 $response = getResponse('admin/view-ajout-livre',array(
     'auteurs' => $auteurs,
     'editeurs' => $editeurs,
     'genres' => $genres
 ));
 echo $response;

