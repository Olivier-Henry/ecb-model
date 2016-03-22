<?php
session_start();

define('ROOT_PATH', realpath(getcwd().'/../src/'));
define('WEB_PATH', getcwd());

require ROOT_PATH.'/conf/config.php';
require ROOT_PATH.'/lib/mvc.php';

$controller = getController();

include ROOT_PATH.'/controllers/'. $controller;