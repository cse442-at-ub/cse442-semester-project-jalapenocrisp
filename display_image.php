
<html>
<body>
		
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
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['imagetmp'] ).'"/>';
    
       // echo "<br> imagename: ". $row["imagename"]. " - pic: ". $row["imagetmp"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>

