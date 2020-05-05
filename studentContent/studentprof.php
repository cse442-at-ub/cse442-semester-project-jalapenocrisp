<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);
$progress= mysqli_query($conn,"SELECT * FROM progress WHERE student_id='" . $_GET['user_id'] . "'");

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
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->
                <li><a class="navlink" href="./admin-chat.php?user_id=<?php echo $row['user_id']; ?>">talk to an admin</a></li>
                <li><a class="navlink" href="./student-appts.php?user_id=<?php echo $row['user_id']; ?>">my appointments</a> </li>
                <li><a class="navlink" href="./search.php?user_id=<?php echo $row['user_id']; ?>">find a tutor</a> </li>
                <div class="dropdown">
                        <li><a class="dropbtn">my progress</a>
                            <div class="dropdown-content">
                                <?php 
                                while ($progressInfo = mysqli_fetch_array($progress)){ 
                                    $linkname=$progressInfo['course'];
                                    $link="./student-progress.php?user_id=" . $_GET['user_id'] . "&cid=" . $linkname ; 
                                    echo "<a href=".$link.">".$linkname."</a>";}
                                ?>
                            </div>
                        </li>
                    </div>                <li><a class="navlink" href="../index.html">logout</a> </li>

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
     echo '<img class="profilePicture" src="../user-default.jpg" alt="you">';
    }
    ?>    
    <br><br><br>
    <div class="cont">
        <button class="dropbtn2">options</button>
            <div class="dropdown-content2">
                <a href='./change-photo-student.php?user_id=<?php echo $row['user_id']; ?>'>edit photo</a>
                <a href='./update-student-profile.php?user_id=<?php echo $row['user_id']; ?>'>edit personal info</a>
                <a href='./delete-profile-student.php?user_id=<?php echo $row['user_id']; ?>'>delete profile</a>
            </div>
    </div>
    <br> 
    <?php if ($row['complete'] / ($row['complete'] + $row['cancel']) < .5) : ?>
    <table class= "info">
    <tr><td>
    <label class= "message">YOUR ACCOUNT HAS BEEN TEMPORARILY BANNED</label>
    </td></tr>
    <tr><td>
    <label class= "message">FOR TOO MANY APPOINTMENT CANCELLATIONS</label>
    </td></tr>
    </table>
    <?php endif ?>
    <br>
    
    <table class="info">

    
    <tr>
    <th width="50%"></th>
    <th width="50%"></th>
    </tr>
    <tr><td>Name: </td><td><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></td></tr>
    <tr><td>Email: </td><td><?php echo $row["email"]; ?></td></tr>
    <tr><td> Phone Number: </td>
    <td><?php 
            echo $row["phone"]; 
            echo "     ";
            if(!$row['verified']){ 
                $link="./verify-text-student.php?user_id=" . $_GET['user_id']; 
                echo "<a class='verify' href=".$link.">verify for live updates</a>";
            }
            ?></td></tr>
    <tr><td>Carrier: </td><td><?php echo $row["carrier"]; ?></td></tr>
    <tr><td>Academic Level: </td><td><?php echo $row["title"]; ?></td></tr>
    <tr><td title="The number of completed appointments(+10) over the number or total appointments.  If your Completion Rate gets to below 50% your account will be banned.">Completion Rate: </td><td><?php echo $row["complete"]; ?>/<?php
    	$num_total =  $row["complete"];
	$num_total += $row["cancel"];

	echo $num_total; 
	?></td></tr>
    </table>
    
    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script>
        
    </script>

</body>

</html>
