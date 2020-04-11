<?php
include_once 'access-db.php';

// $result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
// $sql = "SELECT user_image FROM tutors WHERE user_id='" . $_GET['user_id'] . "'";
// $result
$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

$userid = $_POST["user_id"];


//Insert the image name and image content in image_table
//$insert_image="INSERT INTO tutors (user_image, img_name) VALUES('$imagetmp','$imagename')";

$insert_image = "UPDATE tutors SET user_image='$imagetmp', img_name='$imagename' WHERE user_id= '$userid' " ;

if ($conn->query($insert_image) === TRUE) {
    echo "this is the " .$userid.".";
    echo "New record created successfully. Naviagate back to see your image";
    
} else {
    echo "Error: " . $insert_image . "<br>" . $conn->error;
}

$conn->close();

?>



<!-- 
1. have 2 pages, if they are a new user, use the insert
2. if they are an old user, use the update query stamenet 

1. have another pa

 -->