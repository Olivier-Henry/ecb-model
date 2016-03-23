<?php

$catalogue = getCatalogue();

$response = getResponse('view_produit', array('catalogue' => $catalogue));

echo $response;

