<?php

$vars = array(
    'pageTitle'     => 'Erreur',
);

$response = getResponse(
    'error',
    $vars
);
echo $response;