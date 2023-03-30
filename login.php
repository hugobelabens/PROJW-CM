<?php
    // Functie: classdefinitie User 
    // Auteur: Wigmans

    class User{

        // Eigenschappen 
        public $username;
        public $email;
        private $password;
        
        function SetPassword($password){
            $this->password = $password;
        }
        function GetPassword(){
            return $this->password;
        }

        public function ShowUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
        }
		public function validateUsername() {
        $errors = [];
        if (strlen($this->username) <= 3) {
            array_push($errors, "Username must be longer than 3 characters");
        }
        return $errors;
		}

        public function RegisterUser(){
            $status = false;
            $errors=[];
            if($this->username != "" || $this->password != ""){

                // Check user exist
                if(true){
                    array_push($errors, "Username bestaat al.");
                } else {
                    // username opslaan in tabel login
                    // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                    // Manier 1
                    
                    $status = true;
                }
                            
                
            }
            return $errors;
        }

        function ValidateUser(){
            $errors=[];

            if (empty($this->username)){
                array_push($errors, "Invalid username");
            } else if (empty($this->password)){
                array_push($errors, "Invalid password");
            }

            // Test username > 3 tekens
			if(strlen($username) < 3) {
  // Gebruikersnaam is te kort
  // Toon een foutmelding aan de gebruiker
} else {
  // Gebruikersnaam is geldig
  // Voer de registratie uit of sla de gebruikersnaam op in de database, etc.
$host = 'localhost';
$dbname = 'database_username';
$username = 'database_username';
$password = 'database_password';
$dsn = "mysql:host=$host;dbname=$PROJW-CM";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
}
            
            return $errors;
        }

        public function LoginUser(){

            // Connect database
			$dsn = "mysql:host=$host;dbname=$PROJW-CM";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
			
			

            // Zoek user in de table user
           echo "Username:" . $this->username;


            // Indien gevonden dan sessie vullen


            return true;
        }

        // Check if the user is already logged in
        public function IsLoggedin() {
            // Check if user session has been set
             return false;
        }

        public function GetUser($username){
            
		    // Doe SELECT * from user WHERE username = $username
            if (false){
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = 'Waarde uit de database';
            } else {
                return NULL;
            }   
        }

        public function Logout(){
            session_start();
            // remove all session variables
		
           

            // destroy the session
			 function Logout() {
             session_start();
             session_destroy();
}
            
            header('location: index.php');
        }


    }

    