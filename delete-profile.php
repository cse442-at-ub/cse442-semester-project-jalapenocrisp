<?php
include_once "access-db.php";
$uid=$_GET['user_id'];
$sql  =  "DELETE FROM tutors WHERE id=$uid";
$stmt= $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();

header('Location: ./index.html');
echo "Profile deleted successfully";
?>