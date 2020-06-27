<?php 
    session_start();

    include_once('../questions.php');
    include_once('../models/initialize.php');

    $level = $_SESSION['progress'];

    switch ($level){
        case '0': 
            $answers = array(   isset($_POST['Easy0']) ? $_POST['Easy0'] : "Not Attempted", 
                                isset($_POST['Easy1']) ? $_POST['Easy1'] : "Not Attempted", 
                                isset($_POST['Easy2']) ? $_POST['Easy2'] : "Not Attempted",
                                isset($_POST['Easy3']) ? $_POST['Easy3'] : "Not Attempted",
                                isset($_POST['Easy4']) ? $_POST['Easy4'] : "Not Attempted"
                            );
            break;
        case '1': 
            $answers = array(   isset($_POST['Medium0']) ? $_POST['Medium0'] : "Not Attempted", 
                                isset($_POST['Medium1']) ? $_POST['Medium1'] : "Not Attempted", 
                                isset($_POST['Medium2']) ? $_POST['Medium2'] : "Not Attempted",
                                isset($_POST['Medium3']) ? $_POST['Medium3'] : "Not Attempted",
                                isset($_POST['Medium4']) ? $_POST['Medium4'] : "Not Attempted"
                            );
            break;
        case '2': 
            $answers = array(   isset($_POST['Hard0']) ? $_POST['Hard0'] : "Not Attempted", 
                                isset($_POST['Hard1']) ? $_POST['Hard1'] : "Not Attempted", 
                                isset($_POST['Hard2']) ? $_POST['Hard2'] : "Not Attempted",
                                isset($_POST['Hard3']) ? $_POST['Hard3'] : "Not Attempted",
                                isset($_POST['Hard4']) ? $_POST['Hard4'] : "Not Attempted"
                            );
            break;
        case '3': 
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
        if ($level == '0'){
            if ($EasyAnswers[$i] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $EasyAnswers[$i]);
        } 
        elseif ($level == '1'){
            if ($MediumAnswers[$i] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $MediumAnswers[$i]);
        } 
        elseif ($level == '2'){
            if ($HardAnswers[$i] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $HardAnswers[$i]);
        } 
        elseif ($level == '3'){
            if ($ExtremeAnswers[$i] == $answers[$i]){  $score += 20;  }
            elseif ($answers[$i] == "Not Attempted") { $score += 0; } 
            else { $score -= 5; } 
            array_push($correctAnswers, $ExtremeAnswers[$i]);
        }
    }

    $user = new User();
    $user->username = $_SESSION['username'];

    if ($score > 50){
        if ($level < '3'){
            $level++;
        }
    }
    $user->progress = $level;
    $_SESSION['progress'] = $level;

    /*
    echo "<br>Level: $level <br>";
    echo "<br> Score: ".$score."<br>";
    */

    if ($user->updateLevel()){
        //echo "<br>Level Updated<br>";
    } else {
        //echo "<br>Error in updating<br>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>

    <style>
        *{
            overflow: hidden;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        h1{
            text-align: center;
            color: rgba(0, 29, 49, 0.795);
            margin: 2rem 0;
        }

        table{
            margin: 1rem;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 0);
        }

        table, th, td{
            padding: 1rem;
            border: 0.1rem solid black;
            border-collapse: collapse;
        }

        @media (max-width: 500px){
            h1{
                font-size: 1.5rem;
            }
            table{
                width: 100%;
                position: relative;
                top: 0;
                margin: 1rem 0;
                padding: 0.2rem;
            }
            th, td{
                padding: 0.2rem;
            }
        }

    </style>
</head>
<body style='width: 100%; height: 100vh; overflow: auto;'>

    <div style="text-align: center; width: 100vw; height: 100vh; overflow-y: auto;">
        <h1>Hi <?php echo $_SESSION['username'] ?>, We have calculated your results:</h1>

        <table >
            <tr style="color: black; background: #0383bec4; text-shadow: 0 0 1rem white;">
                <th>Question</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
                <th>Score</th>
            </tr>
            <?php 
                for ($i=1; $i < 6; $i++){
                    echo "  <tr> 
                                <td style='background-color: #0067863f;'>$i</td>
                                <td style='background-color: #35b1eb6b;'>".$answers[$i-1]."</td>
                                <td style='background-color: #35b1eb6b;'>".$correctAnswers[$i-1]."</td>";
                            if ($answers[$i-1]==$correctAnswers[$i-1]){  echo "<td style='background-color: lightgreen;'> +20 </td>";   }
                            elseif ($answers[$i-1]=="Not Attempted"){  echo "<td> 0 </td>";   }
                            else    {  echo "<td style='background-color: pink;'> -5 </td>";   }
                    echo "</tr>";
                }
            ?>
            <tr>
                <td style="border:none"></td><td  style="border:none"></td>
                <th style='background-color: rgba(0,0,0,0.8); color: white;'>Total:</th><td><?php echo $score; ?></td>
            </tr>
        </table>
        
        <a href="../quiz.php" style="text-decoration: none; margin: 4rem; padding: 0.7rem 2rem; border-radius: 0.5rem; background-color: #076caf; color: white; transition: all 1s ease;" >Go to quiz</a>
    </div>
</body>
</html>