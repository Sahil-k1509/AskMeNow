<?php 
    session_start();
    $answers = $_SESSION['answers'];
    $correctAnswers = $_SESSION['correctAnswers'];
    $score = $_SESSION['score'];
    $passingScore = $_SESSION['passingScore'];
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
            top: 30%;
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

        <a href="./quiz.php" style="text-decoration: none; margin: 4rem; padding: 0.7rem 2rem; border-radius: 0.5rem; background-color: #076caf; color: white; transition: all 1s ease;" >Go to quiz</a>
           

            <?php
                if ($score > $passingScore){  echo "<h2 style='margin: 1.5rem; color: green;'>Congrats! You passed the level.</h2>"; }else{ echo "<h2 style='margin: 1.5rem; color: red;'>Please Try again!</h2>"; }
            ?>
        
    </div>
</body>
</html>