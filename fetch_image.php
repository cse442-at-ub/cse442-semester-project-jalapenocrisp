<?php
$servername = "tethys.cse.buffalo.edu";
$username = "jenniech";
$password = "50041501";
$db = "cse442_542_2020_spring_teami_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);


$name=$_GET['name'];

$select_image="select * from image_table where imagename='$name'";

$var=mysql_query($select_image);

if($row=mysql_fetch_array($var))
{
 $image_name=$row["imagename"];
 $image_content=$row["imagecontent"];
}
echo $image;
?>