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

      //read from database
      $query = "select * from Employee_Details where username = '$username' limit 1";
      $result = mysqli_query($con, $query);

      if($result)
      {
        if($result && mysqli_num_rows($result) > 0)
        {

          $user_data = mysqli_fetch_assoc($result);
          
          if($user_data['Password'] === $password)
          {

            $_SESSION['Employee_ID'] = $user_data['Employee_ID'];
            header("Location: car_index.php");
            die;
          }
        }
      }
      
      $error_message = "Wrong username or password. Try Again!";
    }else
    {
      $error_message = "Wrong username or password. Try Again!";
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title> LOGIN </title>
    <link rel="stylesheet" href="car_login.css" />
</head> 
  <body>
    <br><br><br>

    <h1><em>Car Rental Services</em></h1>
    <div class="container">

      <h2>Login</h2>
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

      <button type="submit">Login</button>

      <div class="signup">
          Don't have an account? <a href="car_signup.php">Sign Up</a>
      </div>

    </form>

      
    </div>
  </body>
</html>