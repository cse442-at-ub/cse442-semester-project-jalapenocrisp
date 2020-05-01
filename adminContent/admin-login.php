<?php
$message="";
include_once "../access-db.php";
if(count($_POST)>0) {
	$result = mysqli_query($conn,"SELECT * FROM admin WHERE username='" . $_POST["email"] . "' and password = '". $_POST["paswd"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid request.";
	} else {

        header('Location: ./admin-home.php');
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
    <h1 class="welcome-page-title">Administrator Login</h1>

    <div id="tutor_signup_div">
        <form name="frmUser" method='post' action="">

        <div class="message">
    
        <?php if($message!="") { 
            echo $message; 
            
            } ?> 
        </div> 

            <label for="email">Admin Username</label>
            <input class="log_in_input" type="text" id="email" name="email" placeholder="username" autofocus>

            <label for="password">Password</label>
            <input class="log_in_input" type="password" id="password" name="paswd" placeholder="password">
            
            <input id="log_in_button" name="submit" type="submit" value="Submit">
            <br>
            <br>
            <br>
        </form>
    </div>

    <script src="../index.js"></script>
    
</body>

</html>
