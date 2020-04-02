<?php
    $message="";

    include_once "access-db.php";

    if(count($_POST)>0) {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $pass=$_POST['paswd'];

        $result = mysqli_query($conn,"SELECT * FROM students WHERE email='" . $_POST["email"] . "'");
        $count  = mysqli_num_rows($result);

        if(empty($fname) || empty($lname)){
            $message="Please enter a first and last name.";
        }else if ((strpos( $email, '@buffalo.edu' ) === false)){
            $message="Please enter a valid UB email address.";
        }else if($count>0){
            $message="Email address is already in use.";
        }else if(!preg_match('(^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$)', $pass)){
            $message="Please enter a valid password.";
        }else{
            $sql = "INSERT INTO students (fname, lname, email, paswd) VALUES (?,?,?,?)";
            $stmt= $conn->prepare($sql);
            $stmt->bind_param("ssss", $fname, $lname, $email, $pass);
            $stmt->execute();
        }
    }
                      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>UB Tutoring Student Sign Up</title>
</head>
<body>

    <div class="header">

        <div class="menu_welcomePage">
            <ul>

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->
                <li><a href="./login-student.php">student login</a> </li>
                <li>
                    <a href="./index.html">home</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    
    <h1 class="welcome-page-title">Student Sign Up</h1>

    <div id="tutor_signup_div">
        <form method="post" action="">
            <label>Fields marked * must be filled in order to create an account.</label>
            <br>
            <br>
            <div class="message">
    
                <?php 
                if($message!="") { 
                    echo $message; 
        
                    } ?> 
            </div> 
            <br>
            <br>
            <label for="fname">First Name *</label>

            <input class="sign_up_input" type="text"  id= "fname" name="fname" placeholder="First">

            <label for="lname">Last Name *</label>
            <input class="sign_up_input" type="text" id= "lname" name="lname" placeholder="Last">
            <label for="email">UB Email *</label>
            <input class="sign_up_input" type="text" id= "email" name="email" placeholder="johnsmith@buffalo.edu">

            <label for="password">Password *</label>
            <br>
            <label>Requires at least 8 characters, 1 uppercase, 1 lowercase, 1 special character and 1 number.</label>
            <input class="sign_up_input" type="password" id= "paswd" name="paswd">

            
            <input type="submit" id="tutor_signup_submit" value= "Verify"> 
            <br><br><br>
        </form>

            <!-- <button class="selectButton" onclick="window.location.href = './tutorprofile.html';">Submit</button> -->
    </div>
    <script src="index.js"></script>

    </body>
    </html>
