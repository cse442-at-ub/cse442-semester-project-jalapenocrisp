<?php
include_once "updateDb.php";
$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id=1");
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
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->
                <li><a href="./login.html">login</a> </li>
                <li><a href="./index.html">home</a> </li>
                <li><a href="./index.html">logout</a> </li>
                <li>create account</li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <button class="calendarView" onclick="window.location.href = './tutorCalendarView.html';">Calendar View</button>

    <h1 class="welcome-page-title"></h1>
    <table class= "info" id="profTable">
    <table>

    <?php
    $row = mysqli_fetch_array($result);
    ?>
    <tr>Name: <?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></tr><br>
    <tr>Phone Number: <?php echo $row["phone"]; ?></tr><br>
    <tr>Title: <?php echo $row["title"]; ?></tr><br>
    <tr>Email: <?php echo $row["email"]; ?></tr><br>
    <tr>Course: <?php echo $row["courses"]; ?></tr><br>

    <td><a href="update-process.php?user_id=<?php echo $row["user_id"]; ?>">Update</a></td>    
    </tr>

    </table>
    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        var majors= ["Computer Science", "Mathematics", "Undecided", "Art", "Biology", "Chemistry", "Physics"];
        var classes= ["CSE 115","CSE 116", "CSE 250", "MTH 142", "CSE 331", "PHY 207"];
        
    </script>

</body>

</html>
