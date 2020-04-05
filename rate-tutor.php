<?php
include_once "access-db.php";

$message=""; 

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
<body>
<div class="header">
        <div class="menu_welcomePage">
            <ul>
                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li>
                    <a href="./index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
    </div>


<?php
$row = mysqli_fetch_array($result);
?>
    
<form class = "info1" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
</div>


<input type= "hidden" name="user_id" value="<?php echo $row['user_id']; ?>
<input type="hidden" name="numRatings" class="txtField" value="<?php echo $row['numRatings']; ?>


Rating for Tutor: <?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?> <br>
<input type="text" id="rating" class="txtField" value="Enter a value from 1 - 5">
<br>
<br>

<input type="submit" id="submit" value="Submit" class="button">
</form>


</body>
</html>