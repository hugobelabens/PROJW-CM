<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Get the username and password from the form
	$username = $_POST["username"];
	$password = $_POST["password"];

	// Check if the username and password are correct
	if ($username == "exampleuser" && $password == "examplepass") {
		// If the credentials are correct, set a session variable and redirect to the home page
		session_start();
		$_SESSION["username"] = $username;
		header("Location: home.php");
		exit;
	} else {
		// If the credentials are incorrect, display an error message
		echo "Incorrect username or password.";
	}
}

?>
