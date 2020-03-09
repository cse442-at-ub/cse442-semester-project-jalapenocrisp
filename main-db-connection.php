<?php
/*when you have a pure PHP file, you don't need to close the tag of PHP. Preferred practice.*/

$dbServername= "tethys.cse.buffalo.edu";
$dbUsername= "jenniech";
$dbPassword= "50041501"; //leave it empty when using XAMPP which does not have a password by default.
$dbName= "cse442_542_2020_spring_teami_db";

$conn=mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);