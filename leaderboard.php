<?php 
    session_start();

    $username = $_SESSION['username'];
    $leaderboard = $_SESSION['leaderboard'];


    foreach($leaderboard as $index=>$person){
        $background = $person['username']==$username ? 'lightgreen' : 'pink';
        echo    "<div style='background-color: $background; '>
                    Rank: ".$person['rank']." <br>
                    username: ".$person['username']." <br>
                    TotalScore: ".$person['TotalScore']." <br>
                    ScoreEasy: ".$person['ScoreEasy']." <br>
                    ScoreMedium: ".$person['ScoreMedium']." <br>
                    ScoreHard: ".$person['ScoreHard']." <br>
                    ScoreExtreme: ".$person['ScoreExtreme']." <br>
                </div><hr><br>";
    }

    
    

    echo "<a href='./result.php'>Result</a>";



?>