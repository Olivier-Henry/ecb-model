<?php
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
$recherche = filter_input(INPUT_GET, 'recherche', FILTER_SANITIZE_STRING);

if($page == null){
    $page = 1;
}


$pdo = getPDO();
$dao = new DAOLivre($pdo);
$catalogue = $dao->search(
        array(
            'titre',
            'nom_editeur',
            'nom_auteur',
            'genre'
            ), $recherche, $nbLivresParPage, $page);

//var_dump($catalogue);
//Nombre de résultats
$nbTotalLivres = $dao->getNbLivres()['nb'];

//calcul du nombre de pages
$nbPages = (int)$nbTotalLivres/$nbLivresParPage;

//ajout de 1 au nombre de pages si reste division entière supérieur >0
if($nbTotalLivres%$nbLivresParPage > 0){
    $nbPages++;
}

//Envoi à la vue
$response = getResponse('view_produit', array(
    'catalogue' => $catalogue,
    'nbPages' => $nbPages,
    'nbTotal' => $nbTotalLivres,
    'page' => $page,
    'recherche' => $recherche
        ));

echo $response;

