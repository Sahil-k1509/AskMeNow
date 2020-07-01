<?php 
    session_start();
    include_once('../models/initialize.php');

    $username = $_SESSION['username'];

    $user = new User();
    $user->username = $username;

    $result = $user->createLeaderBoard();
    $num = $result->rowCount();
    if ($num > 0){
        $leaderboard = array();
        $i = 1;
        while ($row = $result->fetch()){
            array_push($leaderboard, array("rank"=>$i, "username"=>$row['username'], "TotalScore"=>$row['Score'], "ScoreEasy"=>$row['MaxScoreEasy'], "ScoreMedium"=>$row['MaxScoreMedium'], "ScoreHard"=>$row['MaxScoreHard'], "ScoreExtreme"=>$row['MaxScoreExtreme']));
            if ($row['username'] == $username){
                $_SESSION['userRank'] = $i;
            }
            $i++;
        }

    } else {
        echo "No people<br>";
    }

    $_SESSION['leaderboard'] = $leaderboard;
    header('Location: ../leaderboard.php');
?>