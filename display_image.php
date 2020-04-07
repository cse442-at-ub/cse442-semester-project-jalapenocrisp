
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>

<!-- the next steps
1. put this picture in a circle frame for display  
2. figure out how and modify the code to display the picture based on the user who is logged in at the time. use user_id
3. move this code to the tutor prof page and re-design the prof. pic part to be a circle and this image showing in the circle
4. you only need the getdata php code and the display image code in the tutor prof oage with the tags ** look into how to implement this part anyway!-->
		
<form method="GET" action="display_image.php" >
 <input type="file" name="your_imagename">
 <input type="submit" name="display_image" value="Display">
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

