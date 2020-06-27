<?php 
    session_start();
    include_once('../models/initialize.php');

    $user = new User();

    $name = $_SESSION['username'];
    echo $name;

    $user->username = $name;

    $user->progress = 0;
    $_SESSION['progress'] = 0;

    if ($user->updateLevel()){
        header("Location: ../quiz.php");
        //echo "<br>Level Updated<br>";
    } else {
        //echo "<br>Error in updating<br>";
    }

?>