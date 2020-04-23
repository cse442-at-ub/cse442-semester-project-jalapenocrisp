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
        echo "Profile deleted successfully, we are sad to see you go!";
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
<body class="main-container">

    <div class="header">

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="welcome-page-title">Enter your password to complete profile delete: </h1>
    <form class = "info1" name="frmUser" method="post" action="">
    <div class="message">
    
    <?php if($message!="") { 
        echo $message; 
        
        } ?> 
    </div> 
    <br>
        Password:<br>
        <input type="password" name="pass" class="input1" placeholder="enter password" autofocus><br>
        <input type="submit" name="submit" value="delete forever" class="selectButton2">




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script>

    </script>

</body>

</html>

