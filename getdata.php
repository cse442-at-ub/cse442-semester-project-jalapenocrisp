<?php
include_once 'access-db.php';

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
//$insert_image="INSERT INTO tutors (user_image, img_name) VALUES('$imagetmp','$imagename')";

$insert_image = "UPDATE tutors SET user_image='$imagetmp', img_name='$imagename' WHERE user_id = 1";

// $sql = "UPDATE tutors SET user_image=?, img_name=?, WHERE account_id=?";

// $stmt = $db_usag->prepare($sql);

// // This assumes the date and account_id parameters are integers `d` and the rest are strings `s`
// // So that's 5 consecutive string params and then 4 integer params

// $stmt->bind_param('sssssdddd', $phone_number, $street_name, $city, $county, $zip_code, $day_date, $month_date, $year_date, $account_id);
// $stmt->execute();




if ($conn->query($insert_image) === TRUE) {
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