<?php
$message="";
if(count($_POST)>0) {
	$conn = mysqli_connect("tethys.cse.buffalo.edu","nekesame","50278839","cse442_542_2020_spring_teami_db");
	$result = mysqli_query($conn,"SELECT * FROM tutors WHERE email='" . $_POST["email"] . "' and paswd = '". $_POST["paswd"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid email or paswd!";
	} else {
        $row = mysqli_fetch_array($result);
        $message = "You are successfully authenticated!";
        $var1=$row['user_id'];
        header('Location: ./tutorprof.php?user_id=' .$var1);
	}
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>UB Tutoring -Log In</title>
</head>

<body>
    <div class="header">
        <div class="menu_welcomePage">
            <ul>
                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li><a href="./login.php">login</a> </li>
                <li>
                    <a href="./index.html">home</a> </li>
                <li>create account</li>
            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
    </div>

    <button class="selectButton" onclick="window.location.href = './tutor_signup.html';">Not Registered? Sign Up

        Here.</button>

    <h1 class="welcome-page-title">Log In</h1>

    <div id="tutor_signup_div">
        <form name="frmUser" method='post' action="">

        <div class="message">
    
        <?php if($message!="") { 
            echo $message; 
            
            } ?> 
        </div> 

            <label for="email">User Email</label>
            <input class="log_in_input" type="text" id="email" name="email" placeholder="Enter @buffalo.edu email...">

            <label for="password">Password</label>
            <input class="log_in_input" type="password" id="password" name="paswd">
            
            <input id="log_in_button" name="submit" type="submit" value="Submit">
            <br>
            <br>
            <br>
            <a href="user_forgot.html" id="forgot_link_id"> forgot password? </a>
        </form>
    </div>

    <script src="index.js"></script>
    
</body>

</html>
