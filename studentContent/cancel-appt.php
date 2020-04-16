<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM appointments WHERE appt_id='" . $_GET["appt_id"] . "'");
$row = mysqli_fetch_array($result);
$tid=$row['tutor_id'];
$tutorRes= mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $tid ."'");
$tutarray = mysqli_fetch_array($tutorRes);

$progress= mysqli_query($conn,"SELECT * FROM progress WHERE student_id='" . $_GET['user_id'] . "'");

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
		<li><a class="navlink" href="./student-appts.php?user_id=<?php echo $_GET['user_id']; ?>">my appointments</a> </li>
                <li><a class="navlink" href="./search.php?user_id=<?php echo $_GET['user_id']; ?>">find a tutor</a> </li>
                <div class="dropdown">
                <li><button onclick="progressclick()" class="dropbtn">my progress</button>
                            <div id="myDropdown" class="dropdown-content">
                                <?php 
                                if (mysqli_num_rows($progress)<1){
                                    echo "<p class='center'>no progress yet</p>";
                                }else{
                                while ($progressInfo = mysqli_fetch_array($progress)){ 
                                    $linkname=$progressInfo['course'];
                                    $link="./student-progress.php?user_id=" . $_GET['user_id'] . "&cid=" . $linkname ; 
                                    echo "<a href=".$link.">".$linkname."</a>";}
                                }
                                ?>
                            </div>
                        </li>
                    </div>                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $_GET['user_id']; ?>">profile</a> </li>
                <li><a href="../index.html">logout</a> </li>

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
    <th width="15%"></th>
    <th width="15%"></th>
    <th width="40%"></th>
    <th width="20%"></th>
    <th width="10%"></th>
    </tr>
    <tr><td><?php echo $row["day"]; ?></td>
        <td><?php if($row["time"]>12){echo $row["time"]-12  . ":00 PM";}else{echo $row["time"]  . ":00 AM";} ?></td>
        <td><?php echo $tutarray["fname"]; ?> <?php echo $tutarray["lname"]; ?></td>
        <td><?php echo $tutarray["courses"]; ?></td>
    </tr>


    <form method="post"> 
        <input type="submit" class="selectButton" name="yes" value="yes" />     
    </form>
    <button onclick="window.location.href ='./student-appts.php?user_id=<?php echo $_GET['user_id']; ?>';"class="selectButton">no</button>




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
            $concat="";
            $day=$row['day'];
            if ($day=="Monday"){
                $concat="mon";
            }else if($day=="Tuesday"){
                $concat="tue";
            }else if($day=="Wednesday"){
                $concat="wed";
            }else if($day=="Thursday"){
                $concat="thu";
            }else if($day=="Friday"){
                $concat="fri";
            }else if($day=="Saturday"){
                $concat="sat";
            }else{
                $concat="sun";
            }
            $time=$row['time'];
            $concat=$concat . $time;


            $sql2  =  "UPDATE calendar SET ";
            $sql2 .= $concat;
            $sql2 .= " =1  WHERE user_id=?";
            $stmt2= $conn->prepare($sql2);
            $stmt2->bind_param("i", $tid);
            $stmt2->execute();
            $stmt2->close();

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

            $subject="Notification of student cancellation";
            $message="Dear " . $tutarray['fname'] . " " . $tutarray['lname'] .":\r\nWe are writing to notify you that your appointment at " . $row['time'] . ":00 on " . $row['day'] . " has been cancelled by the student. No further action is necesary by you.\r\n\r\nUBtutoring\r\n\r\nPlease do not reply to this.";
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
            header('Location: ./student-appts.php?user_id=' . $userid);

        }

    ?>

