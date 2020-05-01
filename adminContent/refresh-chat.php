<?php

include_once "../access-db.php";

$result = mysqli_query($conn,"SELECT * FROM admin WHERE id=0");
$row = mysqli_fetch_array($result);
$chat= $row['chat'];

echo $chat;

?>