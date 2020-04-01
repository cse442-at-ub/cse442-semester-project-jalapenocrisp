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
Level:<br>
<label for="level">Current Educational Level</label>
<select class="txtField" name="title" id= "title">
    <option selected="<?php echo $row['title']; ?>"></option>
    <option value="Undergraduate">Undergraduate</option>
    <option value="Graduate">Graduate</option>
    <option value="Postgraduate">Postgraduate</option>
</select>
<br>
<br>
Email:<br>
<input type="text" name="email" class="txtField" value="<?php echo $row['email']; ?>">
<br>
<br>
Course:<br>
<label for="expertise">CSE Course to tutor</label>

<select class="txtField" name="courses" id= "courses">
                <option selected="choose one"></option>
                <option value="CSE115">CSE115</option>
                <option value="CSE116">CSE116</option>
                <option value="CSE220">CSE220</option>
                <option value="CSE250">CSE250</option>
                <option value="CSE305">CSE305</option>
                <option value="CSE306">CSE306</option>
                <option value="CSE321">CSE321</option>
                <option value="CSE331">CSE331</option>
		        <option value="CSE341">CSE341</option>
		        <option value="CSE365">CSE365</option>
                <option value="CSE368">CSE368</option>
                <option value="CSE370">CSE370</option>
		        <option value="CSE379">CSE379</option>
                <option value="CSE396">CSE396</option>
		        <option value="CSE404">CSE404</option>
		        <option value="CSE411">CSE411</option>
		        <option value="CSE421">CSE421</option>
		        <option value="CSE422">CSE422</option>
		        <option value="CSE426">CSE426</option>
		        <option value="CSE429">CSE429</option>
		        <option value="CSE430">CSE430</option>
		        <option value="CSE431">CSE431</option>
		        <option value="CSE432">CSE432</option>
		        <option value="CSE435">CSE435</option>
		        <option value="CSE443">CSE443</option>
		        <option value="CSE445">CSE445</option>
		        <option value="CSE450">CSE450</option>
		        <option value="CSE451">CSE451</option>
		        <option value="CSE453">CSE453</option>
		        <option value="CSE454">CSE454</option>
		        <option value="CSE455">CSE455</option>
		        <option value="CSE460">CSE460</option>
		        <option value="CSE462">CSE462</option>	
		        <option value="CSE463">CSE463</option>
		        <option value="CSE467">CSE467</option>
		        <option value="CSE468">CSE468</option>
		        <option value="CSE469">CSE469</option>
		        <option value="CSE470">CSE470</option>
		        <option value="CSE473">CSE473</option>	
                <option value="CSE474">CSE474</option>
		        <option value="CSE486">CSE486</option>
                <option value="CSE487">CSE487</option>
                <option value="CSE489">CSE489</option>
		        <option value="CSE490">CSE490</option>
		        <option value="CSE491">CSE491</option>
		        <option value="CSE493">CSE493</option>
</select>
<br>
<br>
Password:<br>

<input type="password" name="paswd" class="txtField" value="<?php echo $row['paswd']; ?>">

<br>
<br>
<input type="submit" name="submit" value="Submit" class="button">
</form>
<button class = "calendarView" onclick="window.location.href = './tutorprof.php?user_id=<?php echo $row['user_id']; ?>';"> Return to profile</button>
</body>
</html>