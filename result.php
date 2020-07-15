<?php 
    session_start();
    $answers = $_SESSION['answers'];
    $correctAnswers = $_SESSION['correctAnswers'];
    $score = $_SESSION['score'];
    $passingScore = $_SESSION['passingScore'];
    $numQuestion = $_SESSION['numQuestions'];
    $level = $_SESSION['presentLevel'];

    $CorrectAdded = 15 + $level*5;
    $WrongPenalty = 3 + $level*6;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            overflow-X: hidden;
        }
        h1{
            text-align: center;
            color: rgba(0, 29, 49, 0.795);
            margin: 2rem 0;
        }

        table{
            margin: 1rem auto;
            padding: 1rem 2rem;
        }

        th, td{
            padding: 1rem 2rem;
            border-right: 0.1rem solid rgba(20, 20, 20, 0.8);
            border-bottom: 0.1rem solid rgba(20, 20, 20, 0.8);
        }

                
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
            background: linear-gradient(#95cce2c5, rgba(12, 49, 71, 0.388));
            border-radius: 0.5rem;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 29, 49, 0.795);
            border-radius: 1rem;
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(0, 90, 146);
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
                transform: translate(0, 0);
            }
            th, td{
                padding: 0.2rem;
            }
        }

    </style>
</head>
<body style='width: 100%;  background-color: rgba(0, 120, 190, 0.3);'>

    <div style="text-align: center; width: 100vw; height: 100%;">
        <h1>Hi <?php echo $_SESSION['username'] ?>, We have calculated your results:</h1>

        <table >
            <tr style="color: black; background: #0383bec4; text-shadow: 0 0 1rem white;">
                <th>Question</th>
                <th>Your Answer</th>
                <th>Correct Answer</th>
                <th>Score</th>
            </tr>
            <?php 
                for ($i=1; $i < $numQuestion + 1; $i++){
                    echo "  <tr> 
                                <td style='background-color: #0067863f;'>$i</td>
                                <td>".$answers[$i-1]."</td>
                                <td>".$correctAnswers[$i-1]."</td>";
                            if ($answers[$i-1]==$correctAnswers[$i-1]){  echo "<td style='background-color: lightgreen;'> +$CorrectAdded </td>";   }
                            elseif ($answers[$i-1]=="Not Attempted"){  echo "<td> 0 </td>";   }
                            else    {  echo "<td style='background-color: pink;'> -$WrongPenalty </td>";   }
                    echo "</tr>";
                }
            ?>
            <tr>
                <th style='background-color: rgba(0,0,0,0.8); color: white;'>Passing Marks:</th><td style='font-weight: 700; font-size: 1.3rem;'><?php echo $passingScore; ?></td>    
                <th style='background-color: rgba(0,0,0,0.8); color: white;'>Total:</th><td style='font-weight: 700; font-size: 1.3rem;'><?php echo $score; ?></td>
            </tr>
        </table>

        <a href="./api/board.php" style='text-decoration: none; color: white; background-color: rgba(0,0,0,0.8); color: white; padding: 0.5rem; border-radius: 0.3rem;'>Check Leader Boards</a>
                    

        <?php
            if ($score > $passingScore){  echo "<h2 style='margin: 1.5rem auto; color: green; box-shadow: 0 0 1rem green, 0 0 2rem green; min-width: 40%; max-width:50%; width: 30rem; border-radius: 1rem;  padding: 0.5rem; background-color: rgba(0, 200, 5, 0.4);'>Congrats! You passed.</h2>"; }else{ echo "<h2 style='margin: 1.5rem auto; color: red; box-shadow: 0 0 1rem red, 0 0 2rem red;  min-width: 40%; max-width:50%; width: 30rem; border-radius: 1rem; padding: 0.5rem; background-color: rgba(200, 0, 0, 0.2);'>Please Try again!</h2>"; }
        ?>

        <a href="./quiz.php" style="text-decoration: none; margin: 4rem; padding: 0.7rem 2rem; border-radius: 0.5rem; background-color: rgba(10, 10, 10, 0.8); color: white; transition: all 1s ease;" >Go to quiz</a> <br><br>
                
    </div>
</body>
</html>