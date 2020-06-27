<?php 
    include_once('../models/initialize.php');

    $user = new User();
    $user->username = isset($_POST['username']) ? $_POST['username'] : die();

    $result = $user->getUser();

    $num = $result->rowCount();

    if ($num > 0){
        $row = $result->fetch();
        if ($row['pwd'] != $_POST['password']){
            header("Location: ../index.php?login=fail");
        } else {
            session_start();    
            $_SESSION['username'] = $row['username'];
            $_SESSION['progress'] = $row['progress'];
            
            //?username=".$row['username']."&progress=".$row['progress']
            
            header("Location: ../quiz.php");
        }
    } else {
        header("Location: ../index.php?hasAccount=no");
    }

?>