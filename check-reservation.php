<?php

session_start();

    // import connection to maintain session and login
    include("car_connection.php");
    include("car_function.php");

    // these varaibles help to print out 
    $message = "";          // display error or success message for sql queries
    $display = "";          // display reservation table entries
    $display2 = "";         // display customer details 
    $display3 = "";         // display car selection details
    $found_message = "";    // if reservation is found or not

    // initialize an empty string for getting car_ID from car database
    $car_ID = "";

    // check if form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Retrieve user's input
        $reservation_num = $_POST['Reservation_no'];

        // reservation number should not be empty and should only contain numbers
        if(!empty($reservation_num) && is_numeric($reservation_num)){

            // Retrieve reservation details 
            $sql = "SELECT * FROM reservation WHERE reservation_no = $reservation_num";
            $result = $con->query($sql);

            // if reservation number if found
            if($result->num_rows > 0){
                $message = "Reservation found! <br> Following are the reservation details:";

                // get details from reservation table
                while($row = $result->fetch_assoc()){
                    $display = "Entry Date: " . $row['Entry_Date'] . "<br>" . "Start Date: " . $row['Start_Date'] . "<br>" .
                    "End Date: " . $row['End_Date'] . "<br>" .
                    "Total Days: " . $row['Total_Days'] . "<br>" .
                    "Total Cost: " . $row['Total_Cost'];

                    // use car id from reservation table to get car details from CAR table
                    $car_ID = $row['Car_ID'];
                    $sql1 = "SELECT * FROM car WHERE Car_ID= $car_ID";
                    $result1 = $con->query($sql1);
                    if($result1->num_rows > 0){
                        while($row1 = $result1->fetch_assoc()){
                            $display2 = "Type: " . $row1['Type'] . "<br>". "Model: " . $row1['Model'] . "<br>" . "Rent_per_day: " . $row1['Rent_per_day'];
                        }
                    }

                    // use customer ID from reservation table to get customer details from that table
                    $customer_ID = $row['Customer_ID'];
                    $sql2 = "SELECT * FROM customer_details WHERE Customer_ID = $customer_ID";
                    $result2 = $con->query($sql2);
                    if($result2->num_rows > 0){
                        while($row2 = $result2->fetch_assoc()){
                            $display3 = "First Name: " . $row2['First_Name'] . "<br>". "Last Name: " . $row2['Last_Name'] . "<br>" . "Phone Number: " . $row2['Phone_No'] . "<br>" . "Home Address: " . $row2['Home_Address'] . "<br>" . "Email ID: " . $row2['Email_ID'] . "<br>" . "City: " . $row2['City'] . "<br>" . "Country: " . $row2['Country'];
                        }
                    }
                }

                // after checking details, user can click link to update it
                $found_message = "Click here to update reservation: <a href='update-reservation.php?reservation_no=$reservation_num'>Update Reservation</a>";
            }
            // reservation number is not found
            else{
                $message = "Error: Reservation number does not exist in the database.";
            }
        }
        // input is not numeric or empty
        else{
            $message = "Invalid input!";
        }
    }

?>



 <!--  website layout-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Check Reservation</title>            // website title
<link rel="stylesheet" href="cancel-reservation.css">       // css file link

</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <a href="car_index.php">Main Menu</a>
    <a href="new-reservation.php">New Reservation</a>
    <a href="update-reservation.php">Update Reservation</a>
    <a href="cancel-reservation.php">Cancel Reservation</a>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
</div>

<!-- Main Content -->
<div class="main">
    <span class="hamburger" onclick="openNav()">&#9776;</span>
</div>

 <!--  heading-->
<h1><em>Check Reservation</em></h1><br>


<div class="master-div-style">
    <form method="post">

     <!--  message displays in red colour-->
      <div id="message" style="color: darkred;"><?php echo $message; ?></div> <br>
      <div id="message" style="color: darkred;"><?php echo $display; ?></div> <br>
      <div id="message" style="color: darkred;"><?php echo $display2; ?></div> <br>
      <div id="message" style="color: darkred;"><?php echo $display3; ?></div> <br>
      <div id="message" style="color: darkred;"><?php echo $found_message; ?></div> <br>


       <!--  reservation number entry-->
        <div class="form-rows">
            <div class="labels">
                <label for="reservation_no" id="name-label">Reservation number</label><br>
            </div>
            <div class="fields">
                <input type="text" id="name" name="Reservation_no" class="input-fields" placeholder="Enter your reservation number" required>
            </div>
        </div>



    <button type="submit">Submit</button>
    </form>
</div>


</body>
</html>

 <!-- java script for side bar-->
<script>

    function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    }

    function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    }
</script>