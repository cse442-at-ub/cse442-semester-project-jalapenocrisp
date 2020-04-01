<?php
include_once "access-db.php";
$message="";

if(count($_POST)>0) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $title=$_POST['title'];
    $courses=$_POST['courses'];                        
    $pass=$_POST['paswd'];

    $result = mysqli_query($conn,"SELECT * FROM tutors WHERE email='" . $_POST["email"] . "'");
    $count  = mysqli_num_rows($result);

    if(empty($fname) || empty($lname)){
        $message="Please enter a first and last name.";
    }else if ((strpos( $email, '@buffalo.edu' ) === false)){
        $message="Please enter a valid UB email address.";
    }else if($count>0){
        $message="Email address is already in use.";
    }else if(!preg_match('(^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$)', $pass)){
        $message="Please enter a valid password.";
    }else if (strlen($phone)!=12){
        $message="Please input phone number as 555-555-5555.";
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
<div class="header">
        <div class="menu_welcomePage">
            <ul>
                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li>
                    <a href="./index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
    </div>
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
            <select class="sign_up_input" name="title" id= "title">
                <option selected="<?php echo $row['title']; ?>"></option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Graduate">Graduate</option>
                <option value="Postgraduate">Postgraduate</option>
            </select><br>
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
<input type="password" name="paswd" class="txtField" value="<?php echo $row['paswd']; ?>">
<br>
<br>
<input type="submit" name="submit" value="Submit" class="button">
</form>
<button class = "calendarView" onclick="window.location.href = './tutorprof.php?user_id=<?php echo $row['user_id']; ?>';"> Return to profile</button>
</body>
</html>