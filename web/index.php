<?php
session_start();

define('ROOT_PATH', realpath(getcwd().'/../src/'));
define('WEB_PATH', getcwd());

require ROOT_PATH.'/conf/config.php';
require ROOT_PATH.'/lib/mvc.php';
require ROOT_PATH.'/lib/databases.php';

function autoloader($class){
    $path = "../classes/DAO/$class.php";
    if(file_exists($path)){
        include_once $path;
    }else{
        throw new Exception("La classe $class n'a pas été trouvée'");
    }
}

spl_autoload_register("autoloader");

setlocale(LC_MONETARY, 'fr_FR');

$controller = getController();

$clientRoute = array(
    '/produit.php'
);

if(!isset($_SESSION['role']) and in_array($controller, $clientRoute)){
    header("Location: /login");
}

include ROOT_PATH.'/controllers/'. $controller;