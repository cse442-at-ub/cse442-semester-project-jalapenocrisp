<?php
$servername = "tethys.cse.buffalo.edu";
$username = "jenniech";
$password = "50041501";
$db = "cse442_542_2020_spring_teami_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="INSERT INTO image_table VALUES('$imagetmp','$imagename')";

mysql_query($conn, $insert_image);

?>