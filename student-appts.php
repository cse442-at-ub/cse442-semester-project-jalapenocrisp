<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);

$result2 = mysqli_query($conn,"SELECT * FROM appointments WHERE student_id='" . $_GET['user_id'] . "'");
$appt = mysqli_fetch_array($result2);
$tid=$row['tutor_id'];

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
                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $row['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="./search.php">find a tutor</a> </li>
                <li><a class="navlink" href="./index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title"><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?>'s Appointments</h1>
    <table class="info">
    <tr>
    <th width="50%"></th>
    <th width="50%"></th>
    </tr>
    <tr><td>Date: </td><td><?php echo $appt["day"]; ?> <?php echo $appt["time"]; ?></td></tr>
    <tr><td>Tutor: </td><td><?php echo $appt["tutor_id"]; ?></td></tr>
    
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>

    </script>

</body>

</html>
