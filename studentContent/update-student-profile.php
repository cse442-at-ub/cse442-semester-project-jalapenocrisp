<?php
include_once "access-db.php";
$message="";

if(count($_POST)>0) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];                     
    $pass=$_POST['paswd'];
    $uid=$_GET['user_id'];

    if(empty($fname) || empty($lname)){
        $message="Please enter a first and last name.";
    }else if ((strpos( $email, '@buffalo.edu' ) === false)){
        $message="Please enter a valid UB email address.";
    }else if(!preg_match('(^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$)', $pass)){
        $message="Please enter a valid password.";
    }else{
        mysqli_query($conn,"UPDATE students SET fname='" . $_POST['fname'] . "', lname='" . $_POST['lname'] . "', email='" . $_POST['email'] . "', paswd='" . $_POST['paswd'] . "' WHERE user_id='" . $_GET['user_id'] . "'"); 
        $message = "Record Modified Successfully";}

    header('Location: ./studentprof.php?user_id=' .$uid);
        
}



$result = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET['user_id'] . "'");
$row= mysqli_fetch_array($result);

$progress= mysqli_query($conn,"SELECT * FROM progress WHERE student_id='" . $_GET['user_id'] . "'");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet"></head>
<body>
<div class="header">
        <div class="menu_welcomePage">
            <ul>
                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li><a class="navlink" href="./student-appts.php?user_id=<?php echo $_GET['user_id']; ?>">my appointments</a> </li>
                <li><a class="navlink" href="./search.php?user_id=<?php echo $_GET['user_id']; ?>">find a tutor</a> </li>
                <div class="dropdown">
                        <li><a class="dropbtn">my progress</a>
                            <div class="dropdown-content">
                                <?php 
                                while ($progressInfo = mysqli_fetch_array($progress)){ 
                                    $linkname=$progressInfo['course'];
                                    $link="./student-progress.php?user_id=" . $_GET['user_id'] . "&cid=" . $linkname ; 
                                    echo "<a href=".$link.">".$linkname."</a>";}
                                ?>
                            </div>
                        </li>
                    </div>                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $_GET['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>
    </div>
    <hr class="hr-navbar">

    <br><br><br><br>
<div class="modal">

<h1 class="welcome-page-title modal-title">Please Save Before Returning</h1>

<form class = "info1" name="frmUser" method="post" action="">

<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
</div>

<div class="modal-input">

First Name:<br>
<input type="text" name="fname" class="input1" value="<?php echo $row['fname']; ?>">
<br>
Last Name:<br>
<input type="text" name="lname" class="input1" value="<?php echo $row['lname']; ?>">
<br>
Level:<br>
<select class="input1" name="title" id= "title">
    <option selected><?php echo $row['title']; ?></option>
    <option value="Undergraduate">Undergraduate</option>
    <option value="Graduate">Graduate</option>
    <option value="Postgraduate">Postgraduate</option>
</select>
<br>
Email:<br>
<input type="text" name="email" class="input1" value="<?php echo $row['email']; ?>">
<br>
Password:<br>

<input type="password" name="paswd" class="input1" value="<?php echo $row['paswd']; ?>">

<br>
Confirm password:<br>
<input type="password" name="paswd2" class="input1" value="<?php echo $row['paswd']; ?>">
<br>
<input id="log_in_button" type="submit" name="submit" value="Save" class="button">
</form>
<br><br>
</div>
</div>
<br>
<br>
<br>
</body>
</html>