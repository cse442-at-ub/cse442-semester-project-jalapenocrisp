<?php

$message="";
include_once "access-db.php";
    
if(count($_POST)>0){

    $zoomLink = $_POST['zoomLink'];

    if(empty($zoomLink)){
	$message="Please enter your Zoom Link"; 
    }else if(strlen($zoomLink)!=22 || strlen($zoomLink)!=23){
    	  $message="PLease enter valid Zoom Meeting Room Url";
    }else{    
     	      mysqli_query($conn,"UPDATE tutors SET zoom_link= $zoomLink WHERE user_id='" . $_GET['user_id'] . "'");
	      $message = "Url added successfully!";
     	      header('Location: ./tutorprof.php?user_id=' . $_GET["user_id"]);     
    }
    
}
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
<body>

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


    
    <input type="button" onclick="window.location='https://zoom.us/signin'" value="Go to Zoom Sign in"/>	 	 
    <br>
    <p>Open the link above in a new tab.</p>
    <br>
    <p>Then, sign into your Zoom account and</p>
    <br>
    <p>copy your meeting link (found below you Personal Meeting ID).</p>
    <br>
    <p>Return to this page and paste it in the textbox below.</p>
     <br>
     <br>
     <form method="post" action="">
	   
	   <br>  
	   <input class="sign_up_input" type="text" id= "zoomLink" name="zoomLink" value="echo $row['zoom-link']">
           <input type="submit" id="tutor_zoom_submit" name="submit" value= "Submit">
     </form>
	
	
<script src="../index.js"></script>

</body>
</html>