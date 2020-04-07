<?php
include_once 'access-db.php';

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="INSERT INTO image_table (imagetmp, imagename) VALUES('$imagetmp','$imagename')";

mysql_query($conn, $insert_image);

?>