<?php 
    define('CSS_PATH', 'templates/CSS/');

    session_start();

    if (!isset($_SESSION['username'])){
        header('Location: ./index.php');
        exit();
    }

    $_SESSION['numQuestions'] = 10;

    include_once('./questions.php');

    function makeLevel($questions){
        echo "<div class='questions-window'>";
        echo "<form action='./api/checkQuiz.php' method='POST'>";
        foreach($questions as $index=>$question){
            echo "<div class='question'>
                    <div class='statement'>Question ".($index+1).": ".$question['question']."</div>
                    <div class='options'> 
                        <div class='choice'><input type='radio' name='".$question['level']."$index' id='".$question['level']."".$index."option1' class='option' value='1'> <label for='option1' >".$question['options'][0]."</label></div>
                        <div class='choice'><input type='radio' name='".$question['level']."$index' id='".$question['level']."".$index."option2' class='option' value='2'> <label for='option2' >".$question['options'][1]."</label></div>
                        <div class='choice'><input type='radio' name='".$question['level']."$index' id='".$question['level']."".$index."option3' class='option' value='3'> <label for='option3' >".$question['options'][2]."</label></div>
                        <div class='choice'><input type='radio' name='".$question['level']."$index' id='".$question['level']."".$index."option4' class='option' value='4'> <label for='option4' >".$question['options'][3]."</label></div>
                        <input type='text' hidden name='answer".$question['level']."$index' style='display:hidden;' value='".$question['answer']."'/>    
                    </div>
                 </div>";
        }
        echo "<button type='submit' name='submit".$questions[0]['level']."' class='submit-btn'>Submit</button>";
        echo "</form>";
        echo "</div>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Me</title>

    
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>main.css">

    <style>
        *{
            font-family: pangolin, serif;
        }
        .instructions-btn{
            padding: 0.5rem 1.4rem;
            margin: 1rem 3rem;
            border: none;
            background-color: rgba(19, 0, 73, 0.856);
            color: white;
            cursor: pointer;
            border-radius: 2rem;
            transition: all 0.6s ease;
        }
        .instructions-btn:hover{
            cursor: pointer;
            transform: translateY(-0.3rem) scale(1.2) rotateY(5deg);
            box-shadow: 0 0 1rem grey;
        }

        .instructions{
            position: absolute;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            overflow: auto;
            z-index: 15;
            transform: translate(0, 0);
            transition: all 0.7s ease;
            background-color: white;
            animation: backgrad 1s ease infinite;
        }

        .hidden{
            transform: translate(0, 100%);
        }

        .instr-li{
            margin: 1rem;
            padding: 0.5rem;
            border: 0.1rem solid black;
            box-shadow: 0 0 1rem grey;
            border-radius: 0.5rem;
            color: white;
        }

        .ins-head{
            font-size: 2rem;
        }

        @media (max-width: 500px){
            .instr-li{{
                font-size: 1rem;
            }
            .ins-head{
                font-size: 1.5rem
            }
        }

    </style>
</head>
<body style='background-color: rgba(0, 15, 25, 0.8);'>

    <div class="cover" id="cover">
        
        <div class="text-container">
            <div class="cover-text">
                I want to play a game.... <br>
                Do you have what it takes to survive?
            </div>
        </div>

        <button class="start-btn" id="start-btn">Start the game</button>
        
    </div>

    <div class="navigation">
        <nav class="navbar">
            <span class="logo">Ask Me Now</span>

            <ul class="nav-list">
                <li class="nav-item"><a href="./api/restart.php" class="nav-link">Restart</a></li>
                <li class="nav-item"><a href="./api/logout.php" class="nav-link">Logout</a></li>
            </ul>
        </nav>
    </div>

    <div style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>

        <div class='greet'>
            <h1>Welcome <?php echo $_SESSION['username'] ?></h1>
        </div>
        
        <!--<img src="./static/images/think.gif" alt="Think" class='think-poster'>-->
        <!--<img src="./static/images/hourglass.gif" alt="HourGlass" class='time-poster'>-->

        <div style="overflow: auto;" class="gamebox">
            <?php 
                $progress = $_SESSION['progress'];
                if ($progress == '0')    {
                    echo "<h2 class='level-heading' style='color:lightgreen;'>Easy Easters</h2>";  
                    shuffle($easyLevel);
                    makeLevel(array_slice($easyLevel, 0, $_SESSION['numQuestions']));     
                }
                else if($progress == '1'){  
                    echo "<h2 class='level-heading' style='color:yellow;'>Normie Networks</h2>";
                    shuffle($MediumLevel);
                    makeLevel(array_slice($MediumLevel, 0, $_SESSION['numQuestions']));   
                }
                else if($progress == '2'){
                    echo "<h2 class='level-heading' style='color:orange;'>Hard Hercules</h2>";  
                    shuffle($HardLevel);
                    makeLevel(array_slice($HardLevel, 0, $_SESSION['numQuestions']));     
                }
                else if($progress == '3'){  
                    echo "<h2 class='level-heading' style='color:red;'>Impossible Iceberg</h2>";
                    shuffle($ExtremeLevel);
                    makeLevel(array_slice($ExtremeLevel, 0, $_SESSION['numQuestions']));  
                }
            ?> 
        </div>

        <button class='instructions-btn' id='instructions-btn'> Instructions </button>

    </div>

    <div class="instructions hidden" id='instructions'>
                <span id='close-instructions' style='text-align: center; cursor: pointer; font-size: 1.4rem; position: absolute; right: 2rem; top: 2rem; color: white; font-weight: 800; background: red; padding: 0.2rem; width: 2rem; height: 2rem; border-radius: 0.5rem;'>&times;</span>
                <div style='padding: 2rem; margin: 1rem; border: 0.1rem solid black; border-radius: 0.7rem;'>
                    <h1 style='color:  white; text-shadow: 0.2rem 0.2rem 0.5rem black; margin: 1rem;' class='ins-head'>Instructions</h1>
                    <ul style='font-size: 1.5rem;'>
                        <li class='instr-li'>Quiz consists of Four levels with 10 questions in each level. Each proceeding level has raised difficulty compared to previous level.</li>
                        <li class='instr-li'>If you repeat the level, all questions may or may not be the same. But, there order will be different each time.</li>
                        <li class='instr-li'>Questions will be based on programming, quantum mechanics, networking and some easy miscellaneous topics.</li>
                        <li class='instr-li'>Your current level will be saved. For instance, if you logout at Lv3, you will continue from same level. But, if there are any marked answers, they will be removed.</li>
                        <li class='instr-li'>You will get a brief summary and answers after you submit the quiz. To proceed to next level, You must score more than the threshold marks (They increase for each level)</li>
                        <li class='instr-li'>There is negative marking for wrong answers.</li>
                        <li class='instr-li'>You can restart your progress anytime with restart button.</li>
                    </ul>
                </div>
    </div>


    <script>
        window.history.forward();

        var cover = document.getElementById('cover');
        var startButton = document.getElementById('start-btn');

        startButton.addEventListener('click', ()=>{
            cover.classList.add('gameStart');
        });

        var instructionButton = document.getElementById('instructions-btn');
        var instructionsCloseButton = document.getElementById('close-instructions');
        var instructions = document.getElementById('instructions');

        instructionButton.addEventListener('click', ()=>{
            instructions.classList.remove('hidden');
        });

        instructionsCloseButton.addEventListener('click', ()=>{
            instructions.classList.add('hidden');
        });

    </script>

</body>
</html>