<?php
include_once 'access-db.php';

echo "this file is being called";

$name=$_GET['name'];

echo $name;
$select_image="select imagetmp from image_table where imagename='$name'";

$var=mysql_query($select_image);

if($row=mysql_fetch_array($var))
{
 $image_name=$row["imagename"];
 $image_content=$row["imagetmp"];

 echo $select_image;
}
else {
    echo "did not find the image match";
}

?>