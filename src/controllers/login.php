<?php

if (isset($_POST['submit'])) {
    $login = filter_input(INPUT_POST, 'login');
    $password = filter_input(INPUT_POST, 'password');
    
    if(checkLogin($login, $password)){
        $response = "Login Ok !";
    }else{
        setFlash('Les informations sont incorrectes');
        $response = getResponse('view-login', array('login' => $login));
    }

} else {

    $response = getResponse('view-login', array('login' => ''));
}

echo $response;
