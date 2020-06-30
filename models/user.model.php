<?php 

    /*
        // Query to Create the table
        $createTableUsersQuery = "CREATE TABLE users(
            id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            userpassword VARCHAR(100) NOT NULL,
            progress INT NOT NULL DEFAULT 0,
            Score INT NOT NULL DEFAULT 0,
            MaxScoreEasy INT NOT NULL DEFAULT 0,
            MaxScoreMedium INT NOT NULL DEFAULT 0,
            MaxScoreHard INT NOT NULL DEFAULT 0,
            MaxScoreExtreme INT NOT NULL DEFAULT 0,
        );"
    */

    class User extends Dbh{
        private $table = 'users';

        public $id;
        public $username;
        public $password;
        public $progress;

        public $Score;
        public $MaxScoreEasy;
        public $MaxScoreMedium;
        public $MaxScoreHard;
        public $MaxScoreExtreme;

        public function addUser(){
            $query = 'INSERT INTO '.$this->table.' (username, userpassword) VALUES (:username, :password)';
            $stmt = $this->connect()->prepare($query);

            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);

            if ($stmt->execute()){  return true;  }
            printf("Error in Adding User: %s.\n", $stmt->error);
            return false;
        }

        public function getUser(){
            $query = 'SELECT id, username, userpassword AS pwd, progress FROM '.$this->table.' WHERE username=:username LIMIT 1;';
            $stmt = $this->connect()->prepare($query);

            $stmt->bindParam(':username', $this->username);
            $stmt->execute();

            return $stmt;
        }

        public function getScore(){
            $query = 'SELECT Score, MaxScoreEasy, MaxScoreMedium, MaxScoreHard, MaxScoreExtreme FROM '.$this->table.' WHERE username=:username LIMIT 1;';
            $stmt = $this->connect()->prepare($query);

            $stmt->bindParam(':username', $this->username);
            $stmt->execute();

            $result = $stmt;

            $num = $result->rowCount();

            if ($num > 0){
                $row = $result->fetch();
                $this->Score = $row['Score'];
                $this->MaxScoreEasy = $row['MaxScoreEasy'];
                $this->MaxScoreMedium = $row['MaxScoreMedium'];
                $this->MaxScoreHard = $row['MaxScoreHard'];
                $this->MaxScoreExtreme = $row['MaxScoreExtreme'];
            }
            //return $stmt;
        }

        public function updateLevel(){
            $query = "UPDATE ".$this->table." SET progress=:progress WHERE username=:username";
            $stmt = $this->connect()->prepare($query);
            
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->progress = htmlspecialchars(strip_tags($this->progress));

            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':progress', $this->progress);

            if ($stmt->execute()){ return true;  } 
            printf("Error %s. \n", $stmt->error);
            return false;
        }

        public function updateScore(){
            $query = "UPDATE ".$this->table." SET score=:Score, MaxScoreEasy=:MaxScoreEasy, MaxScoreMedium=:MaxScoreMedium, MaxScoreHard=:MaxScoreHard, MaxScoreExtreme=:MaxScoreExtreme  WHERE username=:username";
            $stmt = $this->connect()->prepare($query);
            
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->Score = htmlspecialchars(strip_tags($this->Score));
            $this->MaxScoreEasy = htmlspecialchars(strip_tags($this->MaxScoreEasy));
            $this->MaxScoreMedium = htmlspecialchars(strip_tags($this->MaxScoreMedium));
            $this->MaxScoreHard = htmlspecialchars(strip_tags($this->MaxScoreHard));
            $this->MaxScoreExtreme = htmlspecialchars(strip_tags($this->MaxScoreExtreme));

            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':Score', $this->Score);
            $stmt->bindParam(':MaxScoreEasy', $this->MaxScoreEasy);
            $stmt->bindParam(':MaxScoreMedium', $this->MaxScoreMedium);
            $stmt->bindParam(':MaxScoreHard', $this->MaxScoreHard);
            $stmt->bindParam(':MaxScoreExtreme', $this->MaxScoreExtreme);

            if ($stmt->execute()){ return true;  } 
            printf("Error %s. \n", $stmt->error);
            return false;
        }

        public function createLeaderBoard(){
            $query = "SELECT username, Score, MaxScoreExtreme, MaxScoreEasy, MaxScoreMedium, MaxScoreHard FROM ".$this->table." 
                        ORDER BY Score DESC, MaxScoreExtreme DESC, MaxScoreHard DESC, MaxScoreMedium DESC, MaxScoreEasy DESC, username ";
            $stmt = $this->connect()->query($query);

            $stmt->execute();

            return $stmt;
        }

    }

?>