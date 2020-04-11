<?php
include_once 'access-db.php';

if(count($_POST)>0) {
    //$userid=$_POST['user_id'];
    $userid=1;
    $imagename=$_FILES["myimage"]["name"]; 
    //Get the content of the image and then add slashes to it 
    $imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

    //Insert the image name and image content in image_table
    //$insert_image="INSERT INTO tutors (user_image, img_name) VALUES('$imagetmp','$imagename')";

    $insert_image = "UPDATE tutors SET user_image='$imagetmp', img_name='$imagename' WHERE user_id=1 " ;

    if ($conn->query($insert_image) === TRUE) {
        echo "this is the " .$userid.".";
        echo "";
        echo "New record created successfully. Naviagate back to see your image";
        echo "";
        echo '<p><a href="tutorprof.php">Back to tutorprof.php</a>';
    } else {
        echo "Error: " . $insert_image . "<br>" . $conn->error;
    }

    $conn->close();
}
?>



<!-- 
1. have 2 pages, if they are a new user, use the insert
2. if they are an old user, use the update query stamenet 

1. have another pa

 -->