<?php

// to check login
function check_login($con)
{

	if(isset($_SESSION['Employee_ID']))
	{
		// the session stays open until employee ID is same
		$id = $_SESSION['Employee_ID'];
		$query = "select * from Employee_Details where Employee_ID = '$id' limit 1";

		// establish query
		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			// fetch results
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: car_login.php");
	die;

}

// function to generate a random number
function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}