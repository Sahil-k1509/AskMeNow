<?php 
    define('CSS_PATH', 'templates/CSS/');
    session_start();

    $username = $_SESSION['username'];
    $leaderboard = $_SESSION['leaderboard'];

    $personPerPage = 10;
    $num_pages = floor(count($leaderboard)/$personPerPage);
    
    //echo $num_pages."<br>";
    //echo count($leaderboard)/$personPerPage;
    
    if ($num_pages != count($leaderboard)/$personPerPage){
        $num_pages++;
    }

    if (isset($_GET['goto-btn'])){
        if ($_GET['goto']!="" && ($_GET['goto']>0 && $_GET['goto']<=$num_pages)){$currentPage = $_GET['goto'];}
        else {$currentPage = 1;}
    } else {
        $currentPage = 1;
    }

    $peopleToShow = array_slice($leaderboard, ($currentPage-1)*$personPerPage, $personPerPage);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="./jquery-3.5.1.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>main.css">

    <style>
        *{
            overflow: initial;
            font-family: pangolin;
            box-sizing: border-box;
        }
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
            background: linear-gradient(#95cce2c5, rgba(12, 49, 71, 0.788));
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

        table{
            margin: 1rem auto;
            font-size: 1rem;
            border-radius: 0.2rem;
        }

        th, td{
            border: 1px solid black;
            text-align: center;
            border-radius: 0.2rem;
            padding: 0.3rem 0.5rem;
        }

        @media (max-width: 500px){
            table{
                width: 100%;
            }
            th, td{
            padding: 0.3rem 0;
        }
        }

  </style>
</head>
<body class='leader-page'>
        <h1 class='leader-heading'>LEADERBOARD</h1>
        <div class='goto-btn-container' style='display: flex;'>
            <?php
                $firstTime = true;
                for ($i=1; $i <= $num_pages; $i++){
                    if ($i<=1 || $i>=$num_pages || abs($currentPage-$i)<=1 || $i == floor($num_pages/2)){
                        $activePageBtn = $i == $currentPage ? "leader-active-page-btn" : null;
                        echo "<form action='leaderboard.php' method='GET'>";
                        echo "<input hidden type='text' value='$i' name='goto' />";
                        echo "<button type='submit' class='leader-goto-btn $activePageBtn' name='goto-btn'>$i</button>";
                        echo "</form>";
                        $firstTime = true;
                    } else {
                        if ($firstTime) {echo "<div style='font-weight: 900; letter-spacing: 0.04rem;'>.........</div>"; $firstTime = false;}
                        
                    }
                }
                echo "<div style='font-size: 0.8rem; font-weight: 900;'><pre>   OR   </pre></div>";
                echo "<form action='leaderboard.php' method='GET'>";
                echo "<input type='text' placeholder='Enter Page' name='goto' style='border-radius: 0.4rem; border: 1px solid black; padding: 0.1rem; width: 5rem;' />";
                echo "<button type='submit' class='leader-goto-btn' name='goto-btn'>GO!</button>";
                echo "</form>";
            ?>
        </div>

        <div class="leader-container">
            <h1>Global Rankings</h1>
            <table Cellspacing=0 class='leaderboard-table'>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Total Score</th>
                    <th>Score Easy</th>
                    <th>Score Medium</th>
                    <th>Score Hard</th>
                    <th>Score Extreme</th>
                </tr>
                <?php 
                    foreach($peopleToShow as $index=>$person){
                        $active = $person['username'] == $username ? 'active-user-row' : null;
                        echo    "<tr class='$active'>
                                    <th class='rank-col-leader'>".$person['rank']."</th>
                                    <td class='col-uname'>".$person['username']."</td>
                                    <td class='col-score'>".$person['TotalScore']."</td>
                                    <td class='col-easy'>".$person['ScoreEasy']."</td>
                                    <td class='col-med'>".$person['ScoreMedium']."</td>
                                    <td class='col-hard'>".$person['ScoreHard']."</td>
                                    <td class='col-extreme'>".$person['ScoreExtreme']."</td>
                                </tr>";   
                    }
                ?>
            </table>

            <h1>Your Scores</h1>
            <table Cellspacing=0 class='leaderboard-table'>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Total Score</th>
                    <th>Score Easy</th>
                    <th>Score Medium</th>
                    <th>Score Hard</th>
                    <th>Score Extreme</th>
                </tr>
                <?php 
                    echo "<tr>
                        <td class='rank-col-leader'>".$leaderboard[$_SESSION['userRank']-1]['rank']."</td>
                        <td class='col-uname'>".$leaderboard[$_SESSION['userRank']-1]['username']."</td>
                        <td class='col-score'>".$leaderboard[$_SESSION['userRank']-1]['TotalScore']."</td>
                        <td class='col-easy'>".$leaderboard[$_SESSION['userRank']-1]['ScoreEasy']."</td>
                        <td class='col-med'>".$leaderboard[$_SESSION['userRank']-1]['ScoreMedium']."</td>
                        <td class='col-hard'>".$leaderboard[$_SESSION['userRank']-1]['ScoreHard']."</td>
                        <td class='col-extreme'>".$leaderboard[$_SESSION['userRank']-1]['ScoreExtreme']."</td>
                    </tr>" 
                ?>
            </table>
        </div>
            
        <div style='margin: 3rem;'>
            <?php
                echo "<a href='./result.php' class='result-redirect-link'>Result</a>";
            ?>
        </div>

</body>
</html>