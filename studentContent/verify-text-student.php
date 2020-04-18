<?php
    $message="";
    include_once "access-db.php";

    $result1 = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET["user_id"] . "'");
    $row=mysqli_fetch_array($result1);
    $phone=$row['phone'];
    $carrier=$row['carrier'];

    $emaillink="";

    if ($carrier=="AT&T"){
        $emaillink="txt.att.net";
    }else if ($carrier=="T-Mobile"){
        $emaillink="tmomail.net";
    }else if ($carrier=="Verizon"){
        $emaillink="vtext.com";
    }else if ($carrier=="Visible"){
        $emaillink="vzwpix.com";                            
    }else if ($carrier=="Sprint"){
        $emaillink="messaging.sprintpcs.com";
    }else if ($carrier=="Xfinity Mobile"){
        $emaillink="vtext.com";
    }else if ($carrier=="Virgin Mobile"){
        $emaillink="vmobl.com";
    }else if ($carrier=="Tracfone"){
        $emaillink="mmst5.tracfone.com";
    }else if ($carrier=="Simple Mobile"){
        $emaillink="smtext.com";            
    }else if ($carrier=="Mint Mobile"){
        $emaillink="mailmymobile.net";
    }else if ($carrier=="Consumer Cellular"){
        $emaillink="mailmymobile.net";
    }else if ($carrier=="Red Pocket"){
        $emaillink="vtext.com";
    }else if ($carrier=="Metro PCS"){
        $emaillink="mymetropcs.com";
    }else if ($carrier=="Boost Mobile"){
        $emaillink="myboostmobile.com";
    }else if ($carrier=="Cricket"){
        $emaillink="sms.cricketwireless.net";
    }else if ($carrier=="Republic Wireless"){
        $emaillink="text.republicwireless.com";
    }else if ($carrier=="Google Fi"){
        $emaillink="msg.fi.google.com";            
    }else if ($carrier=="U.S. Cellular"){
        $emaillink="email.uscc.net";            
    }else if ($carrier=="Ting"){
        $emaillink="message.ting.com";           
    }else if ($carrier=="Consumer Cellular"){
        $emaillink="mailmymobile.net";            
    }else if ($carrier=="C-Spire"){
        $emaillink="cspire1.com";            
    }else if ($carrier=="Page Plus"){
        $emaillink="vtext.com";           
    }      
        


    if(isset($_POST['text'])) {
        $to=$phone;
        $to.='@';
        $to.=$emaillink;
        $code= strval(mt_rand(100000, 999999));
        $message="<p>Your verification code is </p>";
        $message.="<p> .$code. </p>";
        $from="no-reply@buffalo.com";
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $headers .= "From: ". $from. "\r\n";
        $headers .= "Reply-To: ". $from. "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        $headers .= "X-Priority: 1" . "\r\n";
        mail( $to, '', $message );
        mysqli_query($conn,"UPDATE students SET vcode='" . $code  . "' WHERE user_id='" . $_GET['user_id'] . "'"); 
    }    
        
    if(isset($_POST['verify'])){
        $enteredCode=$_POST["code"];
        $result1 = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET["user_id"] . "'");
        $row=mysqli_fetch_array($result1);
        $code=$row['vcode'];
        if ($code!=$enteredCode){
            $mess="Code is incorrect";
        }else{
            mysqli_query($conn,"UPDATE students SET verified=1 WHERE user_id='" . $_GET['user_id'] . "'"); 
            header('Location: ./studentprof.php?user_id=' . $_GET["user_id"]);
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
                <li><a class="navlink" href="./login-student.php">student login</a> </li>
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
            <input class="sign_up_input" type="text" id= "code" name="code">
            <input type="submit" id="tutor_signup_submit" name="text" value= "Text me a code"> 
            <input type="submit" id="tutor_signup_submit" name="verify" value= "Verify"> 

        <br><br><br>
        </form>
    </div>




    </div>
    <script src="../index.js"></script>

    </body>
    </html>
