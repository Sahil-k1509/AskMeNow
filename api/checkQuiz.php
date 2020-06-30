<?php 
    session_start();

    include_once('../questions.php');
    include_once('../models/initialize.php');

    $level = $_SESSION['progress'];
    $numQuestion = $_SESSION['numQuestions'];
    $answers = array();

    switch ($level){
        case '0':
            $difficulty = "Easy"; 
            break;
        case '1': 
            $difficulty = "Medium";
            break;
        case '2': 
            $difficulty = "Hard";
            break;
        case '3': 
            $difficulty = "Extreme";
            break;
    }

    for ($i=0; $i<$numQuestion; $i++){
        $answer = isset($_POST["$difficulty"."$i"]) ? $_POST["$difficulty"."$i"] : "Not Attempted";
        array_push($answers, $answer);
    }


    $score = 0;
    $correctAnswers = array();

    for ($i=0; $i <$numQuestion; $i++){
        if ($_POST["answer$difficulty"."$i"] == $answers[$i]){  $score += (15 + $level*5);  }
        elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
        else { $score -= (3 + $level*6); } 
        array_push($correctAnswers, $_POST["answer$difficulty"."$i"]);
    }


    $user = new User();
    $user->username = $_SESSION['username'];

    $passingScore = 50 + $level*50;
    $_SESSION['presentLevel'] = $level;

    if ($score > $passingScore){
        if ($level < '3'){
            $level++;
        }
    }
    $user->progress = $level;
    $_SESSION['progress'] = $level;


    
    $_SESSION['answers'] = $answers;
    $_SESSION['correctAnswers'] = $correctAnswers;
    $_SESSION['score'] = $score;
    $_SESSION['passingScore'] = $passingScore;


    $user->getScore();

    $MaxScoreEasy = $user->MaxScoreEasy;
    $MaxScoreMedium = $user->MaxScoreMedium;
    $MaxScoreHard = $user->MaxScoreHard;
    $MaxScoreExtreme = $user->MaxScoreExtreme;

    switch ($_SESSION['presentLevel']){
        case '0':
            if ($score > $MaxScoreEasy){
                $user->MaxScoreEasy = $score;
            }
            break;
        case '1': 
            if ($score > $MaxScoreMedium){
                $user->MaxScoreMedium = $score;
            }
            break;
        case '2': 
            if ($score > $MaxScoreHard){
                $user->MaxScoreHard = $score;
            }
            break;
        case '3': 
            if ($score > $MaxScoreExtreme){
                $user->MaxScoreExtreme = $score;
            }
            break;
    }

    $user->Score = $user->MaxScoreEasy + $user->MaxScoreMedium + $user->MaxScoreHard + $user->MaxScoreExtreme;


    if ($user->updateScore()){
        // pass
    } else {
        echo "<br>Error Occured in updating score<br>";
    }
    
    if ($user->updateLevel()){
        header("Location: ../result.php");
        //echo "<br>Level Updated<br>";
    } else {
        echo "<br>Error in updating Level<br>";
    }
    

?>
