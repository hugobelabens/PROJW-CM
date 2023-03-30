<?php
    // Functie: classdefinitie User 
    // Auteur: Wigmans

    class User{

        // Eigenschappen 
        public $username;
        public $email;
        private $password;
        
        public function ShowUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
        }

        public function RegisterUser(){
            
        }

        function SetPassword($password){
            $this->password = $password;
        }
        function GetPassword(){
            return $this->password;
        }

        function ValidateUser(){
            $errors=[];

            if (empty($this->username)){
                array_push($errors, "Invalid username");
            } else if (empty($this->password)){
                array_push($errors, "Invalid password");
            }
            
            return $errors;
        }
        public function LoginUser(){
            $errors = [];
        
            // Maak verbinding met de database
            $conn = new mysqli("localhost", "username", "password", "database");
        
            // Controleer of de verbinding is gelukt
            if ($conn->connect_error) {
                array_push($errors, "Kan geen verbinding maken met de database: " . $conn->connect_error);
                return false;
            }
        
            // Zoek de gebruiker op basis van de gebruikersnaam en het wachtwoord
            $sql = "SELECT * FROM users WHERE username='" . $conn->real_escape_string($this->username) . "' AND password='" . $conn->real_escape_string($this->password) . "'";
            $result = $conn->query($sql);
        
            // Controleer of er een rij is gevonden
            if ($result->num_rows == 1) {
                // Haal de gebruikersgegevens op
                $row = $result->fetch_assoc();
        
                // Sla de gebruikersgegevens op in de sessie
                session_start();
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_name"] = $row["username"];
                $_SESSION["user_email"] = $row["email"];
        
                // Sluit de databaseverbinding en geef aan dat het inloggen is gelukt
                $conn->close();
                return true;
            } else {
                // Geef aan dat het inloggen is mislukt
                array_push($errors, "Ongeldige gebruikersnaam of wachtwoord");
                $conn->close();
                return false;
            }
        }
        

    

?>