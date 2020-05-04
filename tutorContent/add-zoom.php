<?php

$message="";
include_once "access-db.php";


if(count($_POST)>0){

    $zoomLink = $_POST['zoomLink'];
    $valid = "https://zoom.us/j/";

    if(empty($zoomLink)){
	$message="Please enter your Zoom Link"; 
    }else if(strpos($zoomLink, $valid) >= 1 || strlen($zoomLink)!=28 || substr($zoomLink,0,1) != "h"){
    	$message="Please enter valid Zoom Meeting Room Url";
    }else{    
     	mysqli_query($conn,"UPDATE tutors SET zoom_link='" . $zoomLink . "' WHERE user_id='" . $_GET['user_id'] . "'");
	$message = "Url added successfully!";
     	header('Location: ./tutorprof.php?user_id=' . $_GET["user_id"]);     
    }   
}

$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);

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
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
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

    <h1 class="welcome-page-title modal-title">Update Your Zoom Meeting Link</h1>
    
    <div class="modal-input">
        <br><br>
    <button class="selectButton" onclick="window.open('https://zoom.us/signin','_blank')">Go to Zoom Sign in</button>
    </div>
    <br><br><br>
    <p class="center">Open the link above in a new tab. Then, sign into your Zoom account and copy your meeting link</p> 
    <p class="center">(found below you Personal Meeting ID). Return to this page and paste it in the textbox below.</p>

    <?php if(isset($message)) { echo $message; } ?>
    
    <form method="post" class="info1" action="">
        <div class="modal-input">

	   <input class="sign_up_input" type="text" id="zoomLink" name="zoomLink" value=<?php echo $row['zoom-link']?>>
       <input class= "log_in_button" type="submit" id="tutor_zoom_submit" name="submit" value= "Save">
    </div>
     </form>
     <br>
     <br>
    </div>	
<script src="../index.js"></script>

</body>
</html>
