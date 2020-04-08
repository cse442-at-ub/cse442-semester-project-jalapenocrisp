<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);

$result2 = mysqli_query($conn,"SELECT * FROM appointments WHERE student_id='" . $_GET['user_id'] . "' and status = 'upcoming'");

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

<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li><a class="navlink" href="./search.php?user_id=<?php echo $row['user_id']; ?>">find a tutor</a> </li>
                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $row['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="./index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title">Your Appointments</h1><br>
    <a class="center" href="./student-appt-history.php?user_id=<?php echo $row['user_id']; ?>">appointment history</a>

    <?php 
    if (mysqli_num_rows($result2)<1){
        echo "<br><br><br><br><h2 class='center'>No appointments scheduled.</h2>";
    }else{
    ?>
    <table class="infoAppt">
    <tr>
    <th width="15%">Date</th>
    <th width="15%">Time</th>
    <th width="30%">Tutor</th>
    <th width="20%">Class</th>
    <th width="10%"></th>
    <th width="10%"></th>

    </tr>

    <?php
    while($appt = mysqli_fetch_array($result2)){
    //find tutor name
    $tid=$appt['tutor_id'];
    $tutorRes= mysqli_query($conn,"SELECT * FROM tutors WHERE user_id=$tid");
    $tutarray = mysqli_fetch_array($tutorRes);
    ?>

 
    <tr><td><?php echo $appt["day"]; ?></td>
        <td><?php echo $appt["time"]; ?>:00</td>
        <td><a class="navlink" style="text-decoration: none" href="./tutorprof-student.php?user_id=<?php echo $_GET['user_id']; ?>&tutor_id=<?php echo $tid;?>"><?php echo $tutarray["fname"]; ?> <?php echo $tutarray["lname"]; ?></td>
        <td><?php echo $tutarray["courses"]; ?></td>
        <td><form method="post"><input type="hidden" name="apptid" class="input1" value="<?php echo $appt['appt_id']; ?>"><input type="submit" class="rate" name="yes" value="complete"></form>
        <td><a href="./cancel-appt.php?user_id=<?php echo $_GET['user_id']; ?>&appt_id=<?php echo $appt['appt_id']; ?>">cancel</a><td>

    </tr>

    <?php
    }
    ?>
   
    </table>
    <?php 
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>

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

        header('Location: ./student-appt-history.php?user_id=' . $userid);
    }
?>