<?php
include_once 'access-db.php';

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="INSERT INTO image_table (imagetmp, imagename) VALUES('$imagetmp','$imagename')";

if ($conn->query($insert_image) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $insert_image . "<br>" . $conn->error;
}

$conn->close();

?>
<html>
<head>

    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
    
</head>
<body>

<!-- the next steps
1. put this picture in a circle frame for display  
2. figure out how and modify the code to display the picture based on the user who is logged in at the time. use user_id
3. move this code to the tutor prof page and re-design the prof. pic part to be a circle and this image showing in the circle
4. you only need the getdata php code and the display image code in the tutor prof oage with the tags ** look into how to implement this part anyway!-->
		
<form method="POST" action="display_image.php" enctype="multipart/form-data">
 <input type="file" name="myimage">
 <input type="submit" name="submit_image" value="Upload">
</form>

<?php
include_once 'access-db.php';

$sql = "SELECT imagetmp FROM image_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<img class="profilePicture" src="data:image/jpeg;base64,'.base64_encode( $row['imagetmp'] ).'"/>';
    
       // echo "<br> imagename: ". $row["imagename"]. " - pic: ". $row["imagetmp"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>

