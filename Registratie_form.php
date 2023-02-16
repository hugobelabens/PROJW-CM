<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>
	<h2>Registration Form</h2>
	<form method="post" action="register.php">
		<label for="username">Username:</label>
		<input type="text" name="username" required><br><br>

		<label for="password">Password:</label>
		<input type="password" name="password" required><br><br>

		<label for="email">Email:</label>
		<input type="email" name="email" required><br><br>

		<label for="first_name">First Name:</label>
		<input type="text" name="first_name" required><br><br>

		<label for="last_name">Last Name:</label>
		<input type="text" name="last_name" required><br><br>

		<input type="submit" value="Register">
	</form>
</body>
</html>
