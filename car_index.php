<?php 
session_start();

    // maintain session and login
    include("car_connection.php");
    include("car_function.php");   

    $user_data = check_login($con);

?>

 <!--  design the page-->
<!DOCTYPE html>
<html>
<head>
    <title>Car Rental</title>        <!--  website title-->
    <link href="car_index.css" rel="stylesheet">     <!-- link css file-->

</head>

<body>
     <!--  start navigation bar which contains the links to all functions our website can peform-->
    <nav>
        <ul>
             <!--  car display-->
            <li class="cars true">Cars</li>

             <!--  link to the page for creating new reservation-->
            <li class="new"><a href="new-reservation.php" style="color: white; text-decoration: none;">New Reservation</a></li>

             <!--  link to the page to check reservation details-->
            <li class="cancel"><a href="check-reservation.php" style="color: white; text-decoration: none;">Check Reservation</a></li>

             <!--  link to the page to update reservation-->
            <li class="cancel"><a href="update-reservation.php" style="color: white; text-decoration: none;">Update Reservation</a></li>

             <!--  link to the page to cancel a reservation-->
            <li class="cancel"><a href="cancel-reservation.php" style="color: white; text-decoration: none;">Cancel Reservation</a></li>

             <!--  pressing logout will close the connection and take user back to login screen-->
            <li style="margin-left: auto;"><a href="car_logout.php" style="color: white; text-decoration: none;">Logout</a></li>
        </ul>
    </nav>


 <!--  content box to display all the cars-->
    <main>
        <div class="cars-box">
            <div class="title-box">
                 <!--  clicking each will display the cars in each category-->
                <h2 class="luxury true">Luxury</h2>
                <h2 class="sports">Sports</h2>
                <h2 class="classic">Classic</h2>
            </div>

            <!-- luxury cars -->
            <div class="luxury-section">
                <div class="car">
                    <img src="Rolls Royce Phantom (Blue).png">
                    <h2> Rolls Royce Phantom (Blue) <br><span>Price per day:RM 9800</span></h2>
                </div>
                <div class="car">
                    <img src="Bentley Continental Flying Spur (White).jpg">  
                    <h2>Bentley Continental Flying Spur (White) <br><span>Price per day:RM 4800</span></h2>
                </div>
                <div class="car">
                    <img src="Mercedes Benz CLS 350 (Silver).jpg">
                    <h2>Mercedes Benz CLS 350 (Silver) <br><span>Price per day:RM 1350</span></h2>
                </div>
                <div class="car">
                    <img src="Jaguar S Type (Champagne).jpg">
                    <h2>Jaguar S Type (Champagne) <br><span>Price per day:RM 1350</span></h2>
                </div>
            </div>




            <!-- sports cars -->
            <div class="sports-section">
                <div class="car">
                    <img src="Ferrari F430 Scuderia (Red).jpg">
                    <h2> Ferrari F430 Scuderia (Red) <br><span>Price per day:RM 6000</span></h2>
                </div>
                <div class="car">
                    <img src="Lamborghini Murcielago LP640 (Matte Black).jpg">
                    <h2>Lamborghini Murcielago LP640 (Matte Black) <br><span>Price per day:RM 7000</span></h2>
                </div>
                <div class="car">
                    <img src="Porsche Boxster (White).jpg">
                    <h2>Porsche Boxster (White) <br><span>Price per day:RM 2800</span></h2>
                </div>
                <div class="car">
                    <img src="Lexus SC430 (Black).jpg">
                    <h2>Lexus SC430 (Black) <br><span>Price per day:RM 1600</span></h2>
                </div>
            </div>


            <!-- classic cars -->
            <div class="classic-section">
                <div class="car">
                    <img src="Jaguar MK 2 (White).jpg">
                    <h2>Jaguar MK 2 (White) <br><span>Price per day:RM 2200</span></h2>
                </div>
                <div class="car">
                    <img src="Rolls Royce Silver Spirit Limousine (Georgian Silver).jpg">
                    <h2> Rolls Royce Silver Spirit Limousine (Georgian Silver) <br><span>Price per day:RM 3200</span></h2>
                </div>
                <div class="car">
                    <img src="MG TD (Red).jpg">
                    <h2> MG TD (Red) <br><span>Price per day:RM 2500</span></h2>
                </div>
            </div>

        </div>

    </main>

     <!--  java code for the website layout and button pressing-->
    <script src="index.js"></script>
    
</body>

</html>