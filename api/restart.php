<?php 
    session_start();
    include_once('../models/initialize.php');

    $user = new User();

    $name = $_SESSION['username'];
    echo $name;

    $user->username = $name;

    $user->progress = 0;
    $_SESSION['progress'] = 0;

    $user->Score = 0;
    $user->MaxScoreEasy = 0;
    $user->MaxScoreMedium = 0;
    $user->MaxScoreHard = 0;
    $user->MaxScoreExtreme = 0;

    $user->updateScore();

    if ($user->updateLevel()){
        header("Location: ../quiz.php");
        //echo "<br>Level Updated<br>";
    } else {
        //echo "<br>Error in updating<br>";
    }

?>