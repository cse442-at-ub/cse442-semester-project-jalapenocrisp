<?php
include_once "access-db.php";
if(count($_POST)>0) {
$phone=$_POST['phone'];
$title=$_POST['title'];
$email=$_POST['email'];
$course=$_POST['courses'];
$password=$_POST['paswd'];
if (strlen($phone)!=12){
    echo'<script>alert("Please input phone number as 555-555-5555.")</script>';
}if ($title!='Graduate' && $title!='Postgraduate' && $title!='Undergraduate'){
    echo'<script>alert("Please input title as Undergraduate, Graduate, or Postgraduate.")</script>';
}if ((strpos( $email, '@buffalo.edu' ) === false)){
    echo'<script>alert("Please enter a valid UB email address.")</script>';
}if ((strpos( $course, 'CSE' ) === false) || (strlen($course) < 6)){
    echo'<script>alert("Please enter the course as CSEXXX.")</script>';
}if (strlen($password)<8){
    echo'<script>alert("Please enter a password with the correct format.")</script>';
}else{
    mysqli_query($conn,"UPDATE tutors SET fname='" . $_POST['fname'] . "', lname='" . $_POST['lname'] . "', phone='" . $_POST['phone'] . "' ,title='" . $_POST['title'] . "' , email='" . $_POST['email'] . "', courses='" . $_POST['courses'] . "', paswd='" . $_POST['paswd'] . "' WHERE user_id='" . $_POST['user_id'] . "'"); 
    $message = "Record Modified Successfully";
}


}
$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
$row= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>UB Tutoring Service</title>
</head>
<body>
<form class = "info1" name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
</div>
<input type="hidden" name="user_id" class="txtField" value="<?php echo $row['user_id']; ?>">
<input type="hidden" name="fname" class="txtField" value="<?php echo $row['fname']; ?>">
<input type="hidden" name="lname" class="txtField" value="<?php echo $row['lname']; ?>">
<br>
Phone Number:<br>
<input type="text" name="phone" class="txtField" value="<?php echo $row['phone']; ?>">
<br>
<br>
Title:<br>
<input type="text" name="title" class="txtField" value="<?php echo $row['title']; ?>">
<br>
<br>
Email:<br>
<input type="text" name="email" class="txtField" value="<?php echo $row['email']; ?>">
<br>
<br>
Course:<br>
<input type="text" name="courses" class="txtField" value="<?php echo $row['courses']; ?>">
<br>
<br>
Password:<br>
<input type="text" name="paswd" class="txtField" value="<?php echo $row['paswd']; ?>">
<br>
<br>
<input type="submit" name="submit" value="Submit" class="button">
</form>
<button class = "calendarView" onclick="window.location.href = './tutorprof.php?user_id=<?php echo $row['user_id']; ?>';"> Return to profile</button>
</body>
</html>