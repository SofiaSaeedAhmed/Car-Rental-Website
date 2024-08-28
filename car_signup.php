<?php 
session_start();

	include("car_connection.php");
	include("car_function.php");

	$error_message = "";
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			//save to database
			$user_id = random_num(20);
			$query = "INSERT INTO `employee_details` (`Username`, `Password`, `Employee_ID`) VALUES ('$username','$password', '$user_id')";

			mysqli_query($con, $query);

			header("Location: car_login.php");
			die;
		}else
		{
			$error_message =  "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" href="car_login.css" />
</head>
<body>
	<br><br><br>
	<h1><em>Car Rental Services</em></h1>
	<div class="container">

		<h2>Sign Up</h2>
		<div id="error-message" style="color: red;"><?php echo $error_message; ?></div> <br>

		<div id="box">
		
	<form method="post">

		<div class="form-group"> 
      	<label for="username">Username:</label><br>
      	<input id="text" type="text" name="username"><br><br>
      	</div>

      	<div class="form-group"> 
      	<label for="username">Password:</label><br>
      	<input id="text" type="password" name="password"><br><br>
      	</div>

      	<button type="submit">Signup</button>

		<div class="signup">
          <a href="car_login.php">Click to Login</a>
        </div>
	</form>
	</div>
</body>
</html>