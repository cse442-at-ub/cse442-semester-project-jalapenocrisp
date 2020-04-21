<?php
$message="";
include_once "access-db.php";
if(count($_POST)>0) {
    $result = mysqli_query($conn,"SELECT * FROM tutors WHERE email='" . $_POST["email"] . "'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "This email is not recognized in our system. Please try again.";
	} else {
        $row=mysqli_fetch_array($result);
        $to=$_POST["email"];
        $code= strval(mt_rand(100000, 999999));
        $message="Your verification code is ";
        $message.=$code;
        $from="no-reply@buffalo.com";
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1" . "\r\n";
        $headers .= "From: ". $from. "\r\n";
        $headers .= "Reply-To: ". $from. "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $headers .= "X-Priority: 1" . "\r\n";
        mail($to, $subject, $message, $headers);
        mysqli_query($conn,"UPDATE tutors SET vcode='" . $code  . "' WHERE user_id='" . $row['user_id'] . "'"); 
        header('Location: verify-email-tutor.php?user_id=' . $row['user_id']);

    }  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content ="width=device-width,initial-scale=1,user-scalable=yes" />
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>UB Tutoring Service</title>
</head>

<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li>
                    <a class="navlink" href="../index.html">home</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <!-- <button class="selectButton" onclick ="window.location.href = './tutor_signup.html';">Not Registered? Sign Up Here.</button> -->

    <h1 class="welcome-page-title">Forgot Password</h1>
    <br>
    <br>
    <br>
    <div id="tutor_signup_div">
        <form method="post" action="">
        <div class="message">
    
        <?php if($message!="") { 
            echo $message; 
            
            } ?> 
        </div> 
            
            <label for="email">User Email</label>
            <input class= "log_in_input" type="text" id="email" name="email" placeholder="Enter @buffalo.edu email">

            <input type="submit" id="log_in_button" name="submit" type="submit" value="Submit">


        </form>


            <!-- <button class="selectButton" onclick ="window.location.href = './tutorprofile.html';">Submit</button> -->
    </div>
    <script src="../index.js"></script>
</body>
</html>
