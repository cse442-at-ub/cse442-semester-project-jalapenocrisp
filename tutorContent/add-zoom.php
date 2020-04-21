<?php

$message="";
include_once "access-db.php";


if(count($_POST)>0){

    $zoomLink = $_POST['zoomLink'];

    if(empty($zoomLink)){
	$message="Please enter your Zoom Link"; 
    }else if(strpos($zoomLink, "https://zoom.us/j/") == false || strlen($zoomLink)!=28){
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
    <title>UB Tutoring Service</title>
</head>

<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>
              
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title">Zoom Meeting Link: <?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?> </h1>
    
    <button class="calendarView" onclick="window.location='https://zoom.us/signin'">"Go to Zoom Sign in"</button>
   
   
    <button class="calendarView">
    <br>
    <label>Open the link above in a new tab.</label><br>
    <label>Then, sign into your Zoom account and</label><br>
    <label>copy your meeting link (found below you Personal Meeting ID).</label><br>
    <label>Return to this page and paste it in the textbox below.</label><br>
    <br>

    <?php if(isset($message)) { echo $message; } ?>
    
    <form method="post" class="info1" action="">
	   <input type="hidden" id="fname" value=<?php echo $row['fname']?>>
	   <input type="hidden" id="lname" value=<?php echo $row['lname']?>>
	   <input type="hidden" id="user_id" value=<?php echo $row['user_id']?>>
	   
	   <input class="sign_up_input" type="text" id="zoomLink" name="zoomLink" value=<?php echo $row['zoom-link']?>>
           <input class= "sign_up_input" type="submit" id="tutor_zoom_submit" name="submit" value= "Save">
     </form>
     <br>
     </button>	
     <br>	
<script src="../index.js"></script>

</body>
</html>