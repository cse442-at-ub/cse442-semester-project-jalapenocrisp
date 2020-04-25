<?php
$message="";
if(count($_POST)>0) {
	$conn = mysqli_connect("tethys.cse.buffalo.edu","nekesame","50278839","cse442_542_2020_spring_teami_db");
	$result = mysqli_query($conn,"SELECT * FROM tutors WHERE email='" . $_POST["email"] . "' and paswd = '". $_POST["paswd"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid email or password!";
	} else {
        $row = mysqli_fetch_array($result);
        $message = "You are successfully authenticated!";
        $var1=$row['user_id'];
        header('Location: ./tutor-appts.php?user_id=' .$var1);
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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>UB Tutoring Service</title>
</head>

<body>
    <div class="header">
        <div class="menu_welcomePage">
            <ul>
                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li>
                    <a class="navlink" href="../create-account.html">create account</a> </li>
                <li>
                    <a class="navlink" href="../index.html">home</a> </li>
       

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
    <h1 class="welcome-page-title">Professor Access</h1>


        <!-- enter ub email to verify that you are a UB professor -->

        <form action="list-of-tutors.php">

            <label for="email">Please enter your UB email to verify that you are a UB professor:</label>
            <br>
            <input type="email" id="email" pattern=".+@buffalo.edu" size="30" required>

            <button type="submit"> Submit </button>
        
        </form>

    <script src="../index.js"></script>
    
</body>

</html>
