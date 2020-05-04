<?php
include_once "access-db.php";
$message="";

if(count($_POST)>0) {
    $pass=$_POST['pass'];
    $result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET["user_id"] . "'");
    $row = mysqli_fetch_array($result);
    $pwd=$row['paswd'];
    if ($pwd!=$pass){
        $message = "Passwords do not match";
    }else{
        $uid=$_GET['user_id'];
        $sql  =  "DELETE FROM tutors WHERE user_id=?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $stmt->close();
        header('Location: ../');
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
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
    <title>UB Tutoring Service</title>
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
    <br><br><br><br><br>
    <div class="modal">
    <h1 class="welcome-page-title modal-title ">Enter your password to complete profile delete: </h1>
    <div id="tutor_signup_div">

    <form name="frmUser" method="post" action="">
    <div class="message">
    
    <?php if($message!="") { 
        echo $message; 
        
        } ?> 
    </div> 
    <br>
    <div class="modal-input">

        Password:<br>
        <input type="password" name="pass" class="log_in_input" placeholder="enter password" autofocus><br><br>
        <input type="submit" name="submit" value="delete forever" class="log_in_button"><br><br>

    </div>
    </div>
    <br><br>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script>

    </script>

</body>

</html>

