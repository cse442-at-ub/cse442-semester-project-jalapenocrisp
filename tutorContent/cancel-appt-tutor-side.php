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
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
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
    <br><br><br><br>
    <div class="modal">

    <h1 class="modal-title welcome-page-title">Are you sure you want to delete this appointment? </h1>

    <br><br>

    <table class="infoAppt">
    <tr>
    <th width="15%"></th>
    <th width="15%"></th>
    <th width="40%"></th>
    <th width="30%"></th>
    </tr>
    <tr><td><?php echo $row["day"]; ?></td>
        <td><?php echo $row["time"]; ?>:00</td>
        <td><?php echo $tutarray["fname"]; ?> <?php echo $tutarray["lname"]; ?></td>
    </tr>
    <br><br><br>

    <form method="post"> 
        <input type="submit" class="selectButton" name="yes" value="yes" />     
    </form>
    <button onclick="window.location.href ='./tutor-appts.php?user_id=<?php echo $_GET['user_id']; ?>';"class="selectButton">no</button>

</div>


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
            $subject="Notification of tutor cancellation";
            $message="Dear " . $tutarray['fname'] . " " . $tutarray['lname'] .":\r\nWe are writing to notify you that your appointment at " . $row['time'] . ":00 on " . $row['day'] . " has been cancelled by the student. No further action is necesary by you.\r\n\r\nUBtutoring\r\n\r\nPlease do not reply to this.";
            $from="no-reply@buffalo.com";
            $headers  = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1" . "\r\n";
            $headers .= "From: ". $from. "\r\n";
            $headers .= "Reply-To: ". $from. "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "X-Priority: 1" . "\r\n";
            mail($to, $subject, $message, $headers);
            // mail( '7167170277@vzwpix.com', '', $message );
            header('Location: ./tutor-appts.php?user_id=' . $userid);

        }

    ?>

