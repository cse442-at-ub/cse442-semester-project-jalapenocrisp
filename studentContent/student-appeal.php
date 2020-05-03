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
		
				<?php if($message!="") { 
					echo $message; 
					
					} 
				?> 
			</div> 
			
			<div class="modal-input">

				<label for="appeal_reason">Enter a descriptive message for you appeal</label>
				<input class="log_in_input" type="text" id="appeal_reason" name="appeal_reason" placeholder="Why do you want an appeal?" autofocus>
				
				<input id="log_in_button" name="submit" type="submit" value="Submit Appeal">
				<br>
				<br>
				<br>
				
			</div>
        </form>
    </div>
    <button class="selectButton" onclick="window.location.href = '../index.html';">I changed my mind</button>

    <script src="../index.js"></script>
    
</body>

</html>
