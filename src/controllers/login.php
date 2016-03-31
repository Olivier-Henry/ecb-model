<?php

if (isset($_POST['submit'])) {
    $login = filter_input(INPUT_POST, 'login');
    $password = filter_input(INPUT_POST, 'password');
    
    $pdo = getPDO();
    $dao = new DAOClient($pdo);
    
    if($dao->exist($login, $password)){
        session_regenerate_id(true);
        $_SESSION['role'] = 'client';
        
        $infoClient = array(
            'email' => $login,
            'password' => sha1($password)
        );
        
        $infoClient = $dao->find($infoClient);
        $dto = new DTOClient();
                
        $dto->setId($infoClient[0]['id'])
                ->setEmail($infoClient[0]['email'])
                ->setPassword($infoClient[0]['password']);
    
        $_SESSION['login'] = $login;
        $_SESSION['client'] = serialize($dto);
        
        header('Location: http://chapitre.local');
    }else{
        setFlash('Les informations sont incorrectes');
        $response = getResponse('view-login', array('login' => $login));
    }

} else {

    $response = getResponse('view-login', array('login' => ''));
}

echo $response;
