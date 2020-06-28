<?php 
    session_start();

    include_once('../questions.php');
    include_once('../models/initialize.php');

    $level = $_SESSION['progress'];

    switch ($level){
        case '0':
            $difficulty = "Easy"; 
            $answers = array(   isset($_POST['Easy0']) ? $_POST['Easy0'] : "Not Attempted", 
                                isset($_POST['Easy1']) ? $_POST['Easy1'] : "Not Attempted", 
                                isset($_POST['Easy2']) ? $_POST['Easy2'] : "Not Attempted",
                                isset($_POST['Easy3']) ? $_POST['Easy3'] : "Not Attempted",
                                isset($_POST['Easy4']) ? $_POST['Easy4'] : "Not Attempted"
                            );
            break;
        case '1': 
            $difficulty = "Medium";
            $answers = array(   isset($_POST['Medium0']) ? $_POST['Medium0'] : "Not Attempted", 
                                isset($_POST['Medium1']) ? $_POST['Medium1'] : "Not Attempted", 
                                isset($_POST['Medium2']) ? $_POST['Medium2'] : "Not Attempted",
                                isset($_POST['Medium3']) ? $_POST['Medium3'] : "Not Attempted",
                                isset($_POST['Medium4']) ? $_POST['Medium4'] : "Not Attempted"
                            );
            break;
        case '2': 
            $difficulty = "Hard";
            $answers = array(   isset($_POST['Hard0']) ? $_POST['Hard0'] : "Not Attempted", 
                                isset($_POST['Hard1']) ? $_POST['Hard1'] : "Not Attempted", 
                                isset($_POST['Hard2']) ? $_POST['Hard2'] : "Not Attempted",
                                isset($_POST['Hard3']) ? $_POST['Hard3'] : "Not Attempted",
                                isset($_POST['Hard4']) ? $_POST['Hard4'] : "Not Attempted"
                            );
            break;
        case '3': 
            $difficulty = "Extreme";
            $answers = array(   isset($_POST['Extreme0']) ? $_POST['Extreme0'] : "Not Attempted", 
                                isset($_POST['Extreme1']) ? $_POST['Extreme1'] : "Not Attempted", 
                                isset($_POST['Extreme2']) ? $_POST['Extreme2'] : "Not Attempted",
                                isset($_POST['Extreme3']) ? $_POST['Extreme3'] : "Not Attempted",
                                isset($_POST['Extreme4']) ? $_POST['Extreme4'] : "Not Attempted"
                            );
            break;
    }


    $score = 0;
    $correctAnswers = array();
    for ($i=0; $i <5; $i++){
        if ($_POST["answer$difficulty"."$i"] == $answers[$i]){  $score += 20;  }
        elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
        else { $score -= 5; } 
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

    if ($score > 50){
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
