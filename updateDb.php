<?php
$servername = "tethys.cse.buffalo.edu";
$username = "jenniech";
$password = "50041501";
$db = "cse442_542_2020_spring_teami_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
 
