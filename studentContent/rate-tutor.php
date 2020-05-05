<?php
include_once "access-db.php";

$message=""; 

if(count($_POST)>0){
	$teachRating = $_POST['teachRating'];
	$knowRating = $_POST['knowRating'];
	$timeRating = $_POST['timeRating'];
	$rating = $_POST['rating'];
	
	$rateAvg = ($rating + $timeRating + $knowRating + $teachRating)/4; 	
	
	
	$avg = $_POST['rank'];
		
	$numberOfRatings = $_POST['numRatings'];
	$oldNumRatings = $_POST['numRatings'];
	$numberOfRatings = $numberOfRatings + 1; 
	
	
	$base = $oldNumRatings/$numberOfRatings;

	$avg = $avg * $base;

	$avgModifier = $rateAvg/$numberOfRatings; 

	$avg = $avg + $avgModifier;

	$avg = round($avg, 2);
	
	if(empty($rating) || empty($teachRating) || empty($knowRating) || empty($timeRating)){
		$message="Please enter values for all fields! (Values from 1-5)";
	}else if($rating != 1 && $rating != 2 && $rating != 3 && $rating != 4 && $rating != 5 || $teachRating != 1 && $teachRating != 2 && $teachRating != 3 && $teachRating != 4 && $teachRating != 5 ||$knowRating != 1 && $knowRating != 2 && $knowRating != 3 && $knowRating != 4 && $knowRating != 5 ||$timeRating != 1 && $timeRating != 2 && $timeRating != 3 && $timeRating != 4 && $timeRating != 5){
		 $message="Please enter a number from 1-5 for all fields!";
    	}else{
		 mysqli_query($conn,"UPDATE tutors SET rank='" . $avg . "', numRatings='" . $numberOfRatings . "' WHERE user_id='" . $_POST['user_id'] . "'");
		 $message = "Rating submitted successfully!";
		 header('Location: ./student-appt-history.php?user_id=' . $_GET['user_id']);

    	 }
        
    }

$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['tutor_id'] . "'");
$row = mysqli_fetch_array($result);

$progress= mysqli_query($conn,"SELECT * FROM progress WHERE student_id='" . $_GET['user_id'] . "'");


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
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet"></head>


<body class="main-container">
<div class="header">
        <div class="menu_welcomePage">
            <ul>
		<li><a class="navlink" href="./student-appts.php?user_id=<?php echo $_GET['user_id']; ?>">my appointments</a> </li>
				<li><a class="navlink" href="./search.php?user_id=<?php echo $_GET['user_id']; ?>">find a tutor</a> </li>
				<div class="dropdown">
                <li><button onclick="progressclick()" class="dropbtn">my progress</button>
                            <div id="myDropdown" class="dropdown-content">
                                <?php 
                                if (mysqli_num_rows($progress)<1){
                                    echo "<p class='center'>no progress yet</p>";
                                }else{
                                while ($progressInfo = mysqli_fetch_array($progress)){ 
                                    $linkname=$progressInfo['course'];
                                    $link="./student-progress.php?user_id=" . $_GET['user_id'] . "&cid=" . $linkname ; 
                                    echo "<a href=".$link.">".$linkname."</a>";}
                                }
                                ?>
                            </div>
                        </li>
                    </div>                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $_GET['user_id']; ?>">profile</a> </li>
                <li>
                    <a href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>
    </div>
    <hr class="hr-navbar">

    <br><br><br><br>
    <div class="modal">

    <h1 class="modal-title welcome-page-title">Rating: <?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?> </h1>

<form class = "info1" method="post" action="">

<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
</div>
<div class="modal-input">

<label>Teaching Skills:</label>
<br>
<input class="log_in_input" type='text' name="teachRating" id='teachRating' placeholder="Enter a value from 1-5">
<br><br>

<label>Course Knowledge:</label>
<br>
<input class="log_in_input" type='text' name="knowRating" id='knowRating' placeholder="Enter a value from 1-5">
<br><br>

<label>Timeliness:</label>
<br>
<input class="log_in_input" type='text' name="timeRating" id='timeRating' placeholder="Enter a value from 1-5">
<br><br>

<label>Communication:</label>
<br>
<input class="log_in_input" type='text' name="rating" id='rating' placeholder="Enter a value from 1-5">
<br>
<br>
<br>

<input class="selectButton" type="submit" id="submit" value="Submit" ><br><br>
</div>
</form>

</div>
<br><br><br><br>
</body>
</html>
