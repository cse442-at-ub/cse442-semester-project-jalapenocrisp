<?php
    $message="";
    include_once "access-db.php";

    $result1 = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET["user_id"] . "'");
    $row=mysqli_fetch_array($result1);
 
    if(isset($_POST['text'])) {
        $to=$row['email'];
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
        mail( $to, '', $message );
        mysqli_query($conn,"UPDATE tutors SET vcode='" . $code  . "' WHERE user_id='" . $_GET['user_id'] . "'"); 
    }    
        
    if(isset($_POST['verify'])){
        $enteredCode=$_POST["code"];
        $result1 = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET["user_id"] . "'");
        $row=mysqli_fetch_array($result1);
        $code=$row['vcode'];
        if ($code!=$enteredCode){
            $mess="Code is incorrect";
        }else{
            mysqli_query($conn,"UPDATE tutors SET verified=1 WHERE user_id='" . $_GET['user_id'] . "'"); 
            header('Location: ./password-reset-tutor.php?user_id=' . $_GET["user_id"]);
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
<body>

    <div class="header">

        <div class="menu_welcomePage">
            <ul>
                <li><a class="navlink" href="./login.php">tutor login</a> </li>
                <li><a class="navlink" href="../index.html">home</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title">Enter your verification code:</h1>
    <p class="center">* code may take up to a minute to arrive *</p>
<br>
    <div class="message">
    <?php 
    if($mess!="") { 
        echo $mess; 

        } ?> 
    </div> 
    <div id="tutor_signup_div">
        <form method="post" action="">
            <input class="sign_up_input" type="text" id= "code" name="code" placeholder="enter code" autofocus>
            <input type="submit" id="tutor_signup_submit" name="text" value= "Text me a code"> 
            <input type="submit" id="tutor_signup_submit" name="verify" value= "Verify"> 

        <br><br><br>
        </form>
    </div>




    </div>
    <script src="../index.js"></script>

    </body>
    </html>
