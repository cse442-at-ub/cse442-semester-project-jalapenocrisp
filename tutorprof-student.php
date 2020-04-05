<?php
include_once "access-db.php";

$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'"); 
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
                <li><a href="./login.php">login</a> </li>
                <li><a href="./index.html">home</a> </li>
                <li><a href="./index.html">logout</a> </li>
                <li>create account</li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <button class="calendarView" onclick="window.location.href = './tutor-calendar-view-student.html';">View Tutor's Availability</button>
    <button class="calendarView" onclick="">

    <h1 class="welcome-page-title"></h1>
    <table class="info">

    <?php
    $row = mysqli_fetch_array($result);
    ?>
    
    <tr><td>Name: </td><td><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></td></tr>
    <tr><td>Phone Number: </td><td><?php echo $row["phone"]; ?></td></tr>
    <tr><td>Title: </td><td><?php echo $row["title"]; ?></td></tr>
    <tr><td>Email: </td><td><?php echo $row["email"]; ?></td></tr>
    <tr><td>Course: </td><td><?php echo $row["courses"]; ?></td></tr>
    
    <tr><td>Average Rating: </td><td><?php echo $row["rank"]; ?></td></tr>
    <tr><td>Number of Ratings: </td><td><?php echo $row["numRatings"]; ?></td></tr>
    <tr><td>Score: </td><td><?php echo $row["score"]; ?></td></tr>
    
    </table>
    
    <form method "post">
    <input id='rateTutor' type='submit' name="rate" value = 'Rate this Tutor'>
    <input id='rating' type='text name="rating" value = 'A number 1-5'>

    <?php
    if(isset($_POST['submit'])){
    $var1 = $_POST['rating'];
    if($var1 != 1 && $var1 != 2 && $var1 != 3 && $var1 != 4 && $var1 != 5){
	$message="Please enter a number from 1-5";
    }else{
	mysqli_query($conn,"UPDATE tutors SET rank='" . $_POST['rating'] . "' WHERE user_id='" . $_POST['user_id'] . "'");
	$message = "Rating submitted successfully";
    }
    
    $var2 = $row['user_id'];
    header('Location: ./tutorprof-student.php?user_id=' .$var2);
    }
    ?>
    
    </form>
    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        
    </script>

</body>

</html>
