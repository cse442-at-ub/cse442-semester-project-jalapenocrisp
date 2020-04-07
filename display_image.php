
<?php

$getname = $_GET[' your_imagename '];

echo "< img src = fetch_image.php?name=".$getname." width=200 height=200 >";

?>
<html>
<body>
		
<form method="GET" action="fetch_image.php" >
 <input type="file" name="your_imagename">
 <input type="submit" name="display_image" value="Display">
</form>

</body>
</html>

