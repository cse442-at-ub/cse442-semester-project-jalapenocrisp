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
    <script src="../index.js"></script>
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
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="modal-title welcome-page-title"><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></h1>
    <br>

    <?php
    if ($row['user_image']){
     echo '<img class="profilePicture" src="data:image/jpeg;base64,'. $row['user_image'] .'"/>';
    }else{
        echo '<img class="profilePicture" src="user-default.jpg" alt="you">';
       }
    ?>    
    
    <br>
    <br>

    <div class="cont">
        <button class="dropbtn2">options</button>
            <div class="dropdown-content2">
                <a href='./change-photo.php?user_id=<?php echo $row['user_id']; ?>'>edit photo</a>
                <a href='./add-bio.php?user_id=<?php echo $row['user_id']; ?>'>edit bio</a>
                <a href='./add-zoom.php?user_id=<?php echo $row['user_id']; ?>'>edit zoom link</a>
                <a href='./update-tutor-profile.php?user_id=<?php echo $row['user_id']; ?>'>edit personal info</a>
                <a href='./delete-profile.php?user_id=<?php echo $row['user_id']; ?>'>delete profile</a>
            </div>
    </div>

<br>
<br>

    <?php if ($row['bio_leadership'] != NULL || $row['bio_languages'] != NULL || $row['bio_topics'] != NULL) {
        echo '<h1 class="modal-title-h2 welcome-page-title">Bio</h1>';
        echo '<table class="info">';
        if ($row['bio_leadership'] != NULL) {
            echo '<tr><td>Leadership: </td><td>'.$row["bio_leadership"].'</td></tr>';
        }if ($row['bio_languages'] != NULL) {
            echo '<tr><td>Coding Languages: </td><td>'.$row["bio_languages"].'</td></tr>';
        }if ($row['bio_topics'] != NULL) {
            echo '<tr><td>Topics: </td><td>'.$row["bio_topics"].'</td></tr>';
        }
        echo "</table>";    }
    ?>
    <br><br>
    <hr class="divider">
    <br><br>
    <table class="info">
    <?php if($row['zoom_link']){
        echo "<tr><td>Zoom Link: </td><td>".$row['zoom_link']."</td></tr>";
    }
    ?>
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

    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</body>

</html>

