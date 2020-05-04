<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM appointments WHERE appt_id='" . $_GET["appt_id"] . "'");
$row = mysqli_fetch_array($result);
$tid=$row['student_id'];
$tutorRes= mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $tid ."'");
$tutarray = mysqli_fetch_array($tutorRes);
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
            <li><a class="navlink" href="./tutorCalendarView.php?user_id=<?php echo $_GET['user_id']; ?>">set availability</a> </li>
                <li><a class="navlink" href="./tutor-appts.php?user_id=<?php echo $_GET['user_id']; ?>">appointments</a> </li>
                <li><a class="navlink" href="./tutorprof.php?user_id=<?php echo $_GET['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title">Are you sure you want to delete this appointment? </h1>

    <br><br>

    <table class="infoAppt">
    <tr>
    <th width="30%"></th>
    <th width="30%"></th>
    <th width="40%"></th>
    </tr>
    <tr><td><?php echo $row["day"]; ?></td>
        <td><?php if($row["time"]>12){echo $row["time"]-12  . ":00 PM";}else{echo $row["time"]  . ":00 AM";} ?></td>
        <td><?php echo $tutarray["fname"]; ?> <?php echo $tutarray["lname"]; ?></td>
    </tr>


    <form method="post"> 
        <input type="submit" class="selectButton" name="yes" value="yes" />     
    </form>
    <button onclick="window.location.href ='./tutor-appts.php?user_id=<?php echo $_GET['user_id']; ?>';"class="selectButton">no</button>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script>
   
    </script>

</body>

</html>

    <?php
        if (isset($_POST["yes"])){
            $status="cancelled";
            $userid=$_GET['user_id'];
            $id=$_GET["appt_id"];
            $sql  =  "UPDATE appointments SET status=? WHERE appt_id=?";
            $stmt= $conn->prepare($sql);
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            $stmt->close();

            $to=$tutarray['email'];

            $phone=$tutarray['phone'];
            $carrier=$tutarray['carrier'];
        
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
            $toText=$phone;
            $toText.='@';
            $toText.=$emaillink;

            $time=$row['time'];
            if ($time>12){
                $time=$time-12;
            }

            $subject="Notification of tutor cancellation";
            $message="Dear " . $tutarray['fname'] . " " . $tutarray['lname'] .":\r\nWe are writing to notify you that your appointment at " . $time . ":00 on " . $row['day'] . " has been cancelled by the tutor. No further action is necesary by you.\r\n\r\nUBtutoring\r\n\r\nPlease do not reply to this.";
            $from="no-reply@buffalo.com";
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1" . "\r\n";
            $headers .= "From: ". $from. "\r\n";
            $headers .= "Reply-To: ". $from. "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "X-Priority: 1" . "\r\n";
            mail($to, $subject, $message, $headers);
            if($tutarray['verified']){
                mail( $toText, '', $message );
            }
            header('Location: ./tutor-appts.php?user_id=' . $userid);

        }

    ?>

