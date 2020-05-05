<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);

$result2 = mysqli_query($conn,"SELECT * FROM appointments WHERE tutor_id='" . $_GET['user_id'] . "' and status = 'upcoming'");

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

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li><a class="navlink" href="./tutorCalendarView.php?user_id=<?php echo $_GET['user_id']; ?>">set availability</a> </li>
                <li><a class="navlink" href="./tutorprof.php?user_id=<?php echo $_GET['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="modal-title welcome-page-title">Your Appointments</h1><br>
    <a class="center" href="./tutor-appt-history.php?user_id=<?php echo $_GET['user_id']; ?>">appointment history</a>

    <?php 
    if (mysqli_num_rows($result2)<1){
        echo "<br><br><br><br><h2 class='center'>No appointments scheduled.</h2>";
    }else{
    ?>
    <table class="infoAppt">
    <tr>
    <th width="30%">Date</th>
    <th width="15%">Student</th>
    <th width="15%">Class</th>
    <th width="20%"></th>

    </tr>

    <?php
    while($appt = mysqli_fetch_array($result2)){
    //find student name
    $tid=$appt['student_id'];
    $tutorRes= mysqli_query($conn,"SELECT * FROM students WHERE user_id=$tid");
    $tutarray = mysqli_fetch_array($tutorRes);
    ?>

 
    <tr ><td><?php echo $appt["day"]." "; if($appt["time"]>12){echo $appt["time"]-12  . ":00 PM";}else{echo $appt["time"]  . ":00 AM";}  ?></td>
        <td><a style="text-decoration: none" class="navlink" href="./studentprof-tutor.php?user_id=<?php echo $_GET['user_id']; ?>&student_id=<?php echo $tid;?>"><?php echo $tutarray["fname"]; ?> <?php echo $tutarray["lname"]; ?></td>
        <td><?php echo $row["courses"]; ?></td>
        <td><div class="cont">
            <button class="dropbtn2">options</button>
            <div class="dropdown-content2">
                <a><form method="post"><input type="hidden" name="apptid" value="<?php echo $appt['appt_id']; ?>"><input type="submit" class="complete" name="yes" value="complete"></form></a>
                <a href='mailto:<?php echo $tutarray['email'];?>?subject = Feedback&body = Message'>contact <?php echo $tutarray["fname"]; ?></a>
                <a href='./cancel-appt-tutor-side.php?user_id=<?php echo $_GET['user_id']; ?>&appt_id=<?php echo $appt['appt_id']; ?>'>cancel appointment</a>
            </div></div></td>
        <!-- <td>
        <td><button class="contact-button selectButton" onclick="window.location.href = 'mailto:<?php echo $tutarray['email'];?>?subject = Feedback&body = Message'">Contact</button></td>
        <td><button class="cancel" onclick="window.location.href='./cancel-appt-tutor-side.php?user_id=<?php echo $_GET['user_id']; ?>&appt_id=<?php echo $appt['appt_id']; ?>'">X</button><td> -->

    </tr>

    <?php
    }
    ?>
   
    </table>
    <?php 
    }
    ?>
    <br><br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>

<script>

</script>

</body>

</html>

<?php
    if (isset($_POST["yes"])){
        $id=$_POST['apptid'];      

        $status="completed";
        $userid=$_GET['user_id'];

        $a = mysqli_query($conn,"SELECT * FROM appointments WHERE appt_id='" . $id . "'");
        $arow = mysqli_fetch_array($a);
        $tutor=$arow['tutor_id'];
        $a1 = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $tutor . "'");
        $a1row=mysqli_fetch_array($a1);
        $currscore=$a1row['score']+1;

        $sql  =  "UPDATE tutors SET score=? WHERE user_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("ii", $currscore, $tutor);
        $stmt->execute();
        $stmt->close();
        
        $sql2  =  "UPDATE appointments SET status=? WHERE appt_id=?";
        $stmt1= $conn->prepare($sql2);
        $stmt1->bind_param("si", $status, $id);
        $stmt1->execute();
        $stmt1->close();

        header('Location: ./tutor-appt-history.php?user_id=' . $userid);
    }
?>