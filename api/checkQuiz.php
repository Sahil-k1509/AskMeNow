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

    /*
    for ($i=0; $i <5; $i++){
        if ($level == '0'){
            if ($_POST["answerEasy$i"] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $_POST["answerEasy$i"]);
        } 
        elseif ($level == '1'){
            if ($_POST["answerMedium$i"] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $_POST["answerMedium$i"]);
        } 
        elseif ($level == '2'){
            if ($_POST["answerHard$i"] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $_POST["answerHard$i"]);
        } 
        elseif ($level == '3'){
            if ($_POST["answerExtreme$i"] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $_POST["answerExtreme$i"]);
        }
    }
    */

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

    /*
    echo "<br>Level: $level <br>";
    echo "<br> Score: ".$score."<br>";
    */

    if ($user->updateLevel()){
        header("Location: ../result.php");
        //echo "<br>Level Updated<br>";
    } else {
        echo "<br>Error in updating<br>";
    }

?>
