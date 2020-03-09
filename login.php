<!DOCTYPE html>
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
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->
                <li><a href="./login.html">login</a> </li>
                <li>
                    <a href="./index.html">home</a> </li>
                <li>create account</li>
            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
    </div>
    <button class="selectButton" onclick ="window.location.href = './tutor_signup.html';">Not Registered? Sign Up Here.</button>

    <h1 class="welcome-page-title">Log In</h1>

    <div id="tutor_signup_div">
        <form action="login_verify.php" method='post'>
            
            <label for="email">User Email</label>
            <input class= "log_in_input" type="text" id="email" name="email" placeholder="Enter @buffalo.edu email...">

            <label for="password">Password</label>
            <input class= "log_in_input" type="password" id="password" name="paswd">

            <input id="log_in_button" name="submit" type="submit" value="Submit">
			<br>
            <br>
            <br>
            <a href="user_forgot.html" id="forgot_link_id"> forgot password? </a>
        </form>
    </div>

	<?php
		if(!isset($_GET['login'])){
			exit();
		}
		else{
			$loginCheck = $_GET['login'];

			if($loginCheck == "empty"){
			echo '<p class="error">Please fill all the fields!</p>';
			exit();
				if(!isset($_GET['login'])){
			exit();
		}
		else{
			$loginCheck = $_GET['login'];

			if($loginCheck == "empty"){
				echo '<p class="error">Please fill all the fields!</p>';
				exit();
			}
			elseif ($loginCheck=="nosuchuser") {
				echo '<p class="error">This user does not exist!</p>';
				exit();# code...
			}
			elseif ($loginCheck=="incorrectpass") {
				echo '<p class="error">Incorrect password!</p>';
				exit();# code...
			}
		}}
			elseif ($loginCheck=="nosuchuser") {
				echo '<p class="error">This user does not exist!</p>';
				exit();# code...
			}
			elseif ($loginCheck=="incorrectpass") {
				echo '<p class="error">Incorrect password!</p>';
				exit();# code...
			}
		}
          ?>
    <script src="index.js"></script>
</body>
</html>