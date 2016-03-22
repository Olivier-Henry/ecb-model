<?php
/**
    Obtention du contrôleur à partir de l'url
*/
function getController(){
    $controller = filter_input(INPUT_GET,'url', FILTER_SANITIZE_STRING);
    
    //Contrôleur par défaut
    if(empty($controller)){
        $controller = 'home';
    }
    
    $controller = $controller.'.php';

    //Contrôleur inexistant
    if(! file_exists(ROOT_PATH.'/controllers/'.$controller)){
        $_SESSION['errorMessage'] = 'La page n\'existe pas';
        $controller = 'error.php';
    }

    return $controller;
}

/**
    Obtention de la vue
*/
function getTemplate($template, $vars = array()){
    if(file_exists(ROOT_PATH.'/views/'.$template. '.php')){
        //Exportation des variables utilisées dans la vue
        extract($vars);
        // Activation du buffer
        ob_start();
        include(ROOT_PATH.'/views/'.$template.'.php');
        // Récupération du buffer dans une variable
        $content = ob_get_clean();
        
    // Vue inexistante, on charge la vue des erreurs
    } else if(file_exists(ROOT_PATH.'/views/error.php')){
        $_SESSION['errorMessage'] = 'Impossible de charger le modèle';
        ob_start();
        include(ROOT_PATH . '/views/error.php');
        $content = ob_get_clean();
    // Vue des erreurs inexistante
    } else {
        $content = 'Impossible de charger le modèle';
    }

    return $content;

}

/**
    Gestion des réponse encapsulation de la vue dans un layout
*/
function getResponse($template, $vars = array(), $layout='layout'){
    $vars['viewContent'] = getTemplate($template, $vars);
    $response = getTemplate('layouts/'.$layout, $vars);
    return $response;

}

/****************************************************
 * GESTION DES MESSAGES FLASH
 ****************************************************/

function getFlashArray(){
    if(isset($_SESSION['flashes'])){
        if(is_array($_SESSION['flashes'])){
            $flashes = $_SESSION['flashes'];
        } else {
            $flashes = array();
        }
    } else {
        $flashes = array();
    }

    return $flashes;
}

function setFlash($message){
    //Récupération du tableau des messages flash
    $flashes = getFlashArray();

    array_push($flashes,$message);

    $_SESSION['flashes'] = $flashes;

}

function getFlash(){
    $flashes = getFlashArray();
    $_SESSION['flashes'] = array();

    return $flashes;
}