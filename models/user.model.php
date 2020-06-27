<?php 

    class User extends Dbh{
        private $table = 'users';

        public $id;
        public $username;
        public $password;
        public $progress;
        public $levelOne;
        public $levelTwo;
        public $levelThree;
        public $levelFour;

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

    }

?>