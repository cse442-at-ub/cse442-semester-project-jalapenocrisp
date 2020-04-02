<?php
include_once "access-db.php";
$uid=$_GET['user_id'];
$sql  =  "DELETE FROM tutors WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
echo "deleted";
header('Location: ./index.html');
?>

