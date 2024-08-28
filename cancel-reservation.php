<?php

session_start();

    // import connection to maintain session and login
    include("car_connection.php");
    include("car_function.php");

    // this variable will display any success or error message to the user once form is submitted
    $message = "";

    // check if form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Retrieve user's input
        $reservation_num = $_POST['Reservation_no'];
        $customer_ID = "";

        // reservation number should not be empty and should only contain numbers
        if(!empty($reservation_num) && is_numeric($reservation_num)){

            // Retrieve customer ID so that customer details can also be deleted from database
            $sql1 = "SELECT customer_ID FROM reservation WHERE reservation_no= $reservation_num";
            $result = $con->query($sql1);

            // if no entry is found, it means the reservation number does not exist
            if($result->num_rows > 0){
            // output data
                while($row = $result->fetch_assoc()){
                    $customer_ID = $row["customer_ID"]; 
                }

                // delete the customer detail entries
                $sql2 = "DELETE FROM customer_details WHERE customer_ID = $customer_ID";

                // delete the customer's reservation details
                $sql3 = "DELETE FROM reservation WHERE reservation_no = $reservation_num";

                // if both sql queries are successful then reservation is deleted
                if ($con->query($sql2) === TRUE && $con->query($sql3) === TRUE){
                    $message = "Reservation deleted successfully!";
                }
                // display error if sql queries aren't successful
                else{
                    $message = "Error deleting reservation: " . $conn->error;
                }
            }
            // display error if reservation number is not found
            else{
                $message = "Error: Reservation number does not exist in the database.";
            }
        }
        else{
            // if reservation number is not numerical
            $message = "Invalid input!";
        }
    }

?>



<!-- website layout -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cancel Reservation</title>
<link rel="stylesheet" href="cancel-reservation.css">
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <a href="car_index.php">Main Menu</a>
    <a href="new-reservation.php">New Reservation</a>
    <a href="update-reservation.php">Update Reservation</a>
    <a href="Check-reservation.php">Check Reservation</a>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
</div>

<!-- Main Content -->
<div class="main">
    <span class="hamburger" onclick="openNav()">&#9776;</span>
</div>

<h1><em>Cancel Reservation</em></h1><br>


<div class="master-div-style">
    <form method="post">

      <div id="message" style="color: darkred;"><?php echo $message; ?></div> <br>


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


<!-- java script for sidebar -->
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