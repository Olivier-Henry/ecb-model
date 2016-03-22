<?php
$vars = array(
    'pageTitle'     => 'Home',
);

$response = getResponse(
    'home',
    $vars
);
echo $response;