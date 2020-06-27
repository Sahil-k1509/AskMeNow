<?php 
    include_once('../models/initialize.php');

    $user = new User();
    
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    $result = $user->getUser();

    $num = $result->rowCount();
    
    
    if ($num > 0){
        header("Location: ../index.php?signuperror=exists");
    } else {
        if ($user->addUser()){
            header('Location: ../index.php?signup=success');
        } else {
            header('Location: ../index.php?signup=fail');
        }
    }

?>