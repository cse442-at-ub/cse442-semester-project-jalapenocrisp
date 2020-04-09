<?php
include_once 'access-db.php';
if (isset($_POST['submit_image']))
$imagename=$_FILES['myimage']['name']; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="INSERT INTO image_table VALUES($imagetmp,$imagename)";

mysqli_query($conn,$insert_image);

?>




<html>
<body>
		
<form method="post" enctype='multipart/form-data'>
 <input type="file" name="myimage">
 <input type="submit" name="submit_image" value="Upload">
</form>

</body>
</html>