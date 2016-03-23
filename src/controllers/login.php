<?php

if (isset($_POST['submit'])) {
    $login = filter_input(INPUT_POST, 'login');
    $password = filter_input(INPUT_POST, 'password');
    
    if(checkLogin($login, $password)){
        $response = "Login Ok !";
    }else{
        $response = "Login Ko !";
    }

} else {

    $response = getResponse('view-login');
}

echo $response;
