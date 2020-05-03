<?php
include_once "access-db.php";

$FLAG = FALSE;

$user_id = $_GET["user_id"];
$ress= mysqli_query($conn,"SELECT * FROM students WHERE user_id=$user_id;");
$arr_ = mysqli_fetch_array($tutorRes);
$studentEmail=$arr_['email'];
$studentName = $arr_['fname'] . " " . $arr_['lname'];

if(count($_POST)>0) {
    $syedsEmail = "syedrehm@buffalo.edu";
    $jennysEmail = "jenniech@buffalo.edu";
    $mercysEmail = "nekesame@buffalo.edu";
    $tresEmail = "tjones@buffalo.edu";

    $description = $_POST["appeal_reason"];
    
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/plain; charset=iso-8859-1" . "\r\n";
    $headers .= "From: ". $from. "\r\n";
    $headers .= "Reply-To: ". $from. "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    $headers .= "X-Priority: 1" . "\r\n";

    $subject = "Banned Students Appeal";
    $message = "$studentName has made an appeal with the following -\r\n" . $description;

    mail($studentEmail, $subject, $message, $headers);
    mail($syedsEmail, $subject, $message, $headers);
    mail($jennysEmail, $subject, $message, $headers);
    mail($mercysEmail, $subject, $message, $headers);
    mail($tresEmail, $subject, $message, $headers);

    $FLAG = TRUE;
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
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
    <title>UB Tutoring Service</title>
</head>

<body>
    <div class="header">
        <div class="menu_welcomePage">
            <ul>
                <li><a class="navlink" href="../index.html">home</a> </li>
            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>
    </div>
    <hr class="hr-navbar">

    
    <br>
    <br>
    <br>
    <br>

    <div class="modal">
    <h1 class="welcome-page-title modal-title"> Appeal </h1>
    <br> <br>

    <div id="tutor_signup_div">
        <form name="frmUser" method='post' action="">

			<div class="message">
		
				<?php if($FLAG == TRUE) { 
					echo "Your appeal has been successfully sent\n"; 
					
					} 
				?> 
			</div> 
			
			<div class="modal-input">

				<label for="appeal_reason">Enter a descriptive message for you appeal</label>
				<textarea id="appeal_reason" name="appeal_reason" cols="70" placeholder="Why do you want an appeal?" autofocus></textarea>
				
				<input id="log_in_button" name="submit" type="submit" value="Submit Appeal">
				<br>
				<br>
				<br>
				
			</div>
        </form>
        <button class="selectButton" onclick="window.location.href = '../index.html';">I changed my mind</button>

    </div>
    

    <script src="../index.js"></script>
    
</body>

</html>
