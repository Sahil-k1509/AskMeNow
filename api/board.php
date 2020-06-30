<?php 
    session_start();
    include_once('../models/initialize.php');

    echo "SCORESSSS<br>";
    $username = $_SESSION['username'];
    echo "<br>You are $username <br><hr><br>";

    $user = new User();
    $user->username = $username;

    $result = $user->createLeaderBoard();
    $num = $result->rowCount();
    if ($num > 0){
        $leaderboard = array();
        $i = 1;
        while ($row = $result->fetch()){
            array_push($leaderboard, array("rank"=>$i, "username"=>$row['username'], "TotalScore"=>$row['Score'], "ScoreEasy"=>$row['MaxScoreEasy'], "ScoreMedium"=>$row['MaxScoreMedium'], "ScoreHard"=>$row['MaxScoreHard'], "ScoreExtreme"=>$row['MaxScoreExtreme']));
            $i++;
        }

    } else {
        echo "No people<br>";
    }

    $_SESSION['leaderboard'] = $leaderboard;
    header('Location: ../leaderboard.php');
?>