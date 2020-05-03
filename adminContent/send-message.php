<?php
include_once "../access-db.php";
if ($_POST['message']){
    $name="Admin: ";
    $separator='%%%';
    $id=0;
    $message=$name.$_POST['message'].$separator;
    $result = mysqli_query($conn,"SELECT * FROM admin WHERE id=0");
    $row= mysqli_fetch_array($result);
    $chat=$row['chat'];
    $chat.=$message;
    mysqli_query($conn,"UPDATE admin SET chat='" . $chat . "' WHERE id='" . $id . "'"); 

    echo $message;
}
?>