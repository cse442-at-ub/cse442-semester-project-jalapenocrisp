<?php
include_once "access-db.php";
$choice = mysqli_real_escape_string($conn,$_GET['choice']);
$sql="SELECT * FROM tutors WHERE courses='$choice'";
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result)){
    echo "<option>" . $row['fname'] ." ". $row['lname'] . "</option>";
}
?>