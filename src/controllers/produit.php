<?php

$liste = array(
    'un frigidaire',
    'un évier en fer',
    'un pistogauffre'
);

$response = getResponse('view_produit', array('maListe' => $liste));
echo $response;

