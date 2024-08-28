<?php
session_start();

  // import connection to maintain session and login
  include("car_connection.php");
  include("car_function.php");

  // this variable will display any success or error message to the user once form is submitted
  $message = "";

  // Generate a random reservation number
  $reservation_no = rand(100000, 999999);
  $customer_ID = rand(100000,9999999);


  // Check if the form has been submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the user's input
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_no = $_POST['phone_no'];
    $home_address = $_POST['home_address'];
    $Email_ID = $_POST['Email_ID'];
    $City = $_POST['City'];
    $Country = $_POST['Country'];
    $entry_date = $_POST['entry_date'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_ID = $_POST['car'];

    // calculate total days the car is booked for using start and end date
    $total_days = round(abs(strtotime($end_date) - strtotime($start_date)) / 86400)+1;

    // initialized at 1, will be calculated using rent per day from car database
    $total_rent = 1;

    // date formatting
    $entry_date_formatted = date("d F Y", strtotime($entry_date));
    $start_date_formatted = date("d F Y", strtotime($start_date));
    $end_date_formatted = date("d F Y", strtotime($end_date));


    // Validate the user's input
    if (!empty($first_name) && !is_numeric($first_name) && !empty($last_name) && !is_numeric($last_name) && !empty($phone_no) && is_numeric($phone_no) && !empty($home_address) && !is_numeric($home_address) && !empty($Email_ID) && !is_numeric($Email_ID) && !empty($City) && !is_numeric($City) && is_numeric($reservation_no) && strtotime($start_date) < strtotime($end_date)) {


      // SELECT rent per day of the car chosen from the car database

      $sql3 = "SELECT Rent_per_day FROM car WHERE Car_ID = $car_ID";
      $result = $con-> query($sql3);    // save data in result

      if($result->num_rows > 0){
        // output data
        while($row = $result -> fetch_assoc()){
          // calculate the total rent
          $total_rent = $row["Rent_per_day"] * $total_days;
        }
      }


      // Insert the input into the database

      $sql1 = "INSERT INTO customer_details (first_name,last_name,phone_no,customer_ID,Home_Address,Email_ID,City,Country) VALUES ('$first_name','$last_name','$phone_no','$customer_ID','$home_address','$Email_ID','$City','$Country')";

      $sql2 = "INSERT INTO reservation (entry_date,start_date, end_date, total_days, total_cost ,reservation_no, customer_ID,car_ID) VALUES ('$entry_date_formatted','$start_date_formatted','$end_date_formatted','$total_days','$total_rent','$reservation_no', '$customer_ID', '$car_ID')";


      // check if both insert sql queries connect or not
      if ($con->query($sql1) === TRUE && $con->query($sql2) === TRUE) {

        // new reservation is successful hence reservation number is presented to the user
        $message= "Total rent is: ". $total_rent . "<br>". "Reservation created with reservation number: $reservation_no";
      } else {
        // show the error if new reservation is not successful
        $message= "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    // if the user inputs are not valid
    else {
      $message= "Invalid input or start date is after end date";
    }
  }


?>


<!-- website layout-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New Reservation</title>    <!--website title-->
  <link rel="stylesheet" href="new-reservation.css">  <! -- css page link -->
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar" id="mySidebar">
    <a href="car_index.php">Main Menu</a>
    <a href="update-reservation.php">Update Reservation</a>
    <a href="cancel-reservation.php">Cancel Reservation</a>
    <a href="Check-reservation.php">Check Reservation</a>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <span class="hamburger" onclick="openNav()">&#9776;</span>
  </div>

  <h1><em>Create a New Reservation</em></h1><br>

   <!-- form layout -->
  <div class="master-div-style">
    <form method="post">

      <div id="message" style="color: darkred;"><?php echo $message; ?></div> <br>

      <div class="form-rows">
        <div class="labels">
          <label for="first_name" id="name-label">First Name</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="first_name" class="input-fields" placeholder="Enter your first name" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="last_name" id="name-label">Last Name</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="last_name" class="input-fields" placeholder="Enter your last name" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="phone_no" id="name-label">Phone Number</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="phone_no" class="input-fields" placeholder="Enter your phone number" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="home_address" id="name-label">Home Address</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="home_address" class="input-fields" placeholder="Enter your home adress" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="Email_ID" id="name-label">Email ID</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="Email_ID" class="input-fields" placeholder="Enter your Email Address" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="City" id="name-label">City</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="City" class="input-fields" placeholder="Enter your city" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="Country" id="name-label">Country</label><br>
        </div>
        <div class="fields">
          <input type="text" id="name" name="Country" class="input-fields" placeholder="Enter your country" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="car_types" id="dropdown-label">Type of Car</label>
        </div>
        <div class="fields">
          <select id="car_types" name="car" class="dropdown" required>
              <option value="" disabled selected>Select car type</option>
              <option value="Luxury">Luxury Car</option>
              <option value="Sports">Sports Car</option>
              <option value="Classic">Classic Car</option>
          </select>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="car_models">Car Model</label>
        </div>
        <div class="fields">
          <select class="dropdown" name="car" id="car_models" disabled required>
              <option value="" name= "car" disabled selected>Select Car Model</option>
          </select>
        </div>
      </div>

      <div class="form-rows">
        <div class="labels">
          <label for="entry_date" id="name_label" >Entry Date</label>
        </div>
        <div class="fields">
          <input type="date" id="entry_date" name="entry_date" class="input-fields" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="start_date" id="name_label" >Booking Start Date</label>
        </div>
        <div class="fields">
          <input type="date" id="start_date" name="start_date" class="input-fields" required>
        </div>
      </div>


      <div class="form-rows">
        <div class="labels">
          <label for="end_date" id="name-label" >Booking End Date</label>
        </div>
        <div class="fields">
          <input type="date" id="end_date" name="end_date" class="input-fields" required>
        </div>
      </div>


      <button type="submit">Submit</button>

    </form>
  </div>


</body>
</html>

 <!--  java for displaying car options

// in our code, a drop down menu asks user to select luxury, sports or classic

// each three types has different models and the drop down display depends on the above three types -->

<script>
  const carTypesSelect = document.getElementById('car_types');
  const carModelsSelect = document.getElementById('car_models');

  carTypesSelect.addEventListener('change', () => {
    // Clear previous options
    carModelsSelect.innerHTML = '<option value="">Select Car Model</option>';

    // Get selected car type
    const selectedCarType = carTypesSelect.value;

    if (selectedCarType === 'Luxury') {
      // Add luxurious car models
      carModelsSelect.add(new Option('Rolls Royce Phantom (Blue) – RM 9800 ', '112023', false, false));
      carModelsSelect.add(new Option('Bentley Continental Flying Spur (White) - RM 4800 ', '122023', false, false));
      carModelsSelect.add(new Option('Mercedes Benz CLS 350 (Silver) - RM 1350 ', '132023', false, false));
      carModelsSelect.add(new Option('Jaguar S Type (Champagne) - RM 1350 ', '142023', false, false));

    } else if (selectedCarType === 'Sports') {
      // Add sports car models
      carModelsSelect.add(new Option('Ferrari F430 Scuderia (Red) - RM 6000', '252023', false, false));
      carModelsSelect.add(new Option('Lamborghini Murcielago LP640 (Matte Black) - RM 7000', '262023', false, false));
      carModelsSelect.add(new Option('Porsche Boxster (White) - RM 2800', '272023', false, false));
      carModelsSelect.add(new Option('Lexus SC430 (Black) - RM 1600', '282023', false, false));

    } else if (selectedCarType === 'Classic') {
      // Add classic car models
      carModelsSelect.add(new Option('Jaguar MK 2 (White) - RM 2200', '392023', false, false));
      carModelsSelect.add(new Option('Rolls Royce Silver Spirit Limousine (Georgian Silver) - RM 3200', '3102023', false, false));
      carModelsSelect.add(new Option('MG TD (Red) - RM 2500', '3112023', false, false));
    }


    // Enable car models select
    carModelsSelect.disabled = false;
  });

    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
    }
</script>