<?php

// use either "localhost" or "localhost:3307" depending on your port in XAMPP

$dbhost = "localhost:3307";
$dbuser = "root";
$dbpass = "";
$dbname = "COMP1044_database";	// sql database name

// set connection
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}