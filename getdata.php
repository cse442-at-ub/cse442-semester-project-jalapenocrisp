<?php
include_once 'access-db.php';

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="INSERT INTO tutors (user_image, img_name) VALUES('$imagetmp','$imagename')";

if ($conn->query($insert_image) === TRUE) {
    echo "New record created successfully. Naviagate back to see your image";
} else {
    echo "Error: " . $insert_image . "<br>" . $conn->error;
}

$conn->close();

?>