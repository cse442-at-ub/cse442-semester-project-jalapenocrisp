<?php
include_once "access-db.php";
$message="";

if(count($_POST)>0) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];                     
    $pass=$_POST['paswd'];


    if(empty($fname) || empty($lname)){
        $message="Please enter a first and last name.";
    }else if ((strpos( $email, '@buffalo.edu' ) === false)){
        $message="Please enter a valid UB email address.";
    }else if(!preg_match('(^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$)', $pass)){
        $message="Please enter a valid password.";
    }else{
        mysqli_query($conn,"UPDATE students SET fname='" . $_POST['fname'] . "', lname='" . $_POST['lname'] . "', email='" . $_POST['email'] . "', paswd='" . $_POST['paswd'] . "' WHERE user_id='" . $_POST['user_id'] . "'"); 
        $message = "Record Modified Successfully";
}


}
$result = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET['user_id'] . "'");
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

<h1 class="welcome-page-title">Please Save Before Returning</h1>

<form class = "info1" name="frmUser" method="post" action="">

<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
</div>
<input type="hidden" name="user_id" class="input1" value="<?php echo $row['user_id']; ?>">
<input type="hidden" name="fname" class="input1" value="<?php echo $row['fname']; ?>">
<input type="hidden" name="lname" class="input1" value="<?php echo $row['lname']; ?>">

Email:<br>
<input type="text" name="email" class="input1" value="<?php echo $row['email']; ?>">
<br>
<br>

Password:<br>

<input type="password" name="paswd" class="input1" value="<?php echo $row['paswd']; ?>">

<br>
<br>
<input type="submit" name="submit" value="Save" class="button">
</form>
<button class = "calendarView" onclick="window.location.href = './studentprof.php?user_id=<?php echo $row['user_id']; ?>';"> Return to profile</button>
<br>
<br>
<br>
</body>
</html>