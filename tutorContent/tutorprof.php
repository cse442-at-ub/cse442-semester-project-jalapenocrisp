<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);
$uid=$_GET['user_id'];
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
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title"><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></h1>
    <br>

    <?php
    if ($row['user_image']){
     echo '<img class="profilePicture" src="data:image/jpeg;base64,'. $row['user_image'] .'"/>';
    }else{
        echo '<img class="profilePicture" src="user-default.jpg" alt="you">';
       }
    ?>    
    
    <button class="calendarView" onclick="window.location.href = './change-photo.php?user_id=<?php echo $row['user_id']; ?>';">Add/Edit Photo</button>

    
    <table class = "info">
    <tr><td><?php echo $row['zoom_link']?></td></tr>
    </table>	
    <button class="calendarView" onclick="window.location.href = './add-zoom.php?user_id=<?php echo $row['user_id']; ?>';">Add/Edit Zoom Link</button>
    <br>


    <table class="info">

    <tr><td> Phone Number: </td>
    <td><?php 
            echo $row["phone"]; 
            echo "     ";
            if(!$row['verified']){ 
                $link="./verify-text-tutor.php?user_id=" . $_GET['user_id']; 
                echo "<a class='verify' href=".$link.">verify for live updates</a>";
            }
            ?></td></tr>
    <tr><td>Carrier: </td><td><?php echo $row["carrier"]; ?></td></tr>
    <tr><td>Academic Level: </td><td><?php echo $row["title"]; ?></td></tr>
    <tr><td>Email: </td><td><?php echo $row["email"]; ?></td></tr>
    <tr><td>Course: </td><td><?php echo $row["courses"]; ?></td></tr>
    <tr><td>Rating: </td><td><?php echo $row["rank"]; ?></td></tr>
    <tr><td class="score" title="The number of tutoring hours you have completed.">Score: </td><td><?php echo $row["score"]; ?></td></tr>
    
    </table>
    <button class="selectButton" onclick="window.location.href ='./update-tutor-profile.php?user_id=<?php echo $row['user_id']; ?>';">Edit Information</button>  
    
    <button class="delButton" onclick="window.location.href ='./delete-profile.php?user_id=<?php echo $row['user_id']; ?>';">Delete Profile</button> 
    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        
    </script>

</body>

</html>

