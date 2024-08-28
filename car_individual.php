
<?php
include("car_connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Page</title>
    <link href="car.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="car-details">
            <h1>Rent now</h1>
            <?php
            $car_name = $_GET['car_name'];
            $car_colour = $_GET['car_colour'];
            $rental_rate = $_GET['rental_rate'];
            $car_type = $_GET['car_type'];
            echo "<img src=\"$car_name.jpg\"></img>";
            echo "<h2>$car_name</h2>";
            echo "<h2>Car Type: $car_type</h2>";
            echo "<h2>Car colour: $car_colour</h2>";
            echo "<h2>RM $rental_rate per day</h2>";
        
            ?>
        </div>

        <div class="form-container">
            <form name="form" method="POST" onsubmit="return valid()">
                <div class="input-box-date">
                    <label for="start-date"> Start Date: </label>
                    <input type="date" id="start-date" name="start-date">
                </div>

                <div class="input-box-date">
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end-date">
                </div>

                <div id="submit-button">
                    <input type="submit" value="Submit" name="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <br>
                <br>

                <div id="submit-button">
                    <button id="back-button" onclick="return back()"> Go back to homepage</button>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </form>
        </div>
    </main>


    <script>

        // function to check for date entered
        function valid(){
            let start = document.getElementById("start-date").value;
            let end = document.getElementById("end-date").value;
            let startDate = new Date(start);
            let endDate = new Date(end);
            let currentDate = new Date();
            currentDate.setHours(0,0,0);
            if(start == "" || end == ""){
                alert("Please fill in the date");
                return false;
            }
            else if(start > end){
                alert("Invalid! Start date cannot be after end date");
                document.getElementById("start-date").value = "";
                document.getElementById("end-date").value = "";
                return false;
            }
            else if(startDate < currentDate){
                alert("Invalid! Start date cannot be in the future");
                document.getElementById("start-date").value = "";
                document.getElementById("end-date").value = "";
                return false;
            }
            else{
                let diff = endDate - startDate;
                let price = <?php echo $price; ?>;
                let diffDays = Math.floor(diff/(1000*60*60*24));  // convert the difference to days
                let clientResponse = confirm("You have booked this car for " + diffDays + " days. Please pay RM" + diffDays*price);
                if(clientResponse == false){
                    document.getElementById("start-date").value = "";
                    document.getElementById("end-date").value = "";
                    alert("Booking Cancelled");
                    return false;
                }
                alert("Booking has been made");
                document.forms["form"].action = "car_index.php";
                return true;
            }
        }



        // function to go back to homepage
        function back() {
            window.location.href = "car_index.php";
            return false;
        }
    </script>

</body>

</html>