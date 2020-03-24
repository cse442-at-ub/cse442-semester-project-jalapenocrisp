<?php
$servername = "tethys.cse.buffalo.edu";
$username = "wogreen";
$password = "50233919";
$dbname = "cse442_542_2020_spring_teami_db";

$user = $_GET['u'];  
$pass = $_GET['p'];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$command = "SELECT * FROM tutors WHERE email = ? AND paswd = ?";
$statement = mysqli_prepare($conn, $command);
mysqli_stmt_bind_param($statement, "ss", $user, $pass);
mysqli_stmt_execute($statement);

mysqli_stmt_bind_result($statement, $user_id, $fname, $lname, $phone, $title, $email, $courses, $paswd); 

mysqli_stmt_fetch($statement);

if(strlen($fname) != 0){
echo "{First Name:" . $fname . ", Last Name:" . $lname . "}";
} else { 
echo "Error! Tutor not found in database!"; 
}


mysqli_close($conn);
?>