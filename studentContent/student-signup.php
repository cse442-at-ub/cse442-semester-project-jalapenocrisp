<?php
   include_once "access-db.php";
   
   $message="";

   if(count($_POST)>0) {
       $fname=$_POST['fname'];
       $lname=$_POST['lname'];
       $email=$_POST['email'];
       $pass=$_POST['paswd'];
       $title=$_POST['title'];
       $phone=$_POST['phone'];
       $pass2=$_POST['paswd2'];
       $carrier=$_POST["carrier"];

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
       }else if($pass!=$pass2){
           $message="Passwords do not match!";
       }else if (strlen($phone)!=10){
           $message="Please input a 10 digit phone number.";
       }else if (!$title){
           $message="Please choose an academic level.";    
       }else if (!$carrier){
           $message="Please choose a carrier.";
       }else{
           $sql = "INSERT INTO students (fname, lname, email, paswd, title, phone, carrier) VALUES (?,?,?,?,?,?,?)";
           $stmt= $conn->prepare($sql);
           $stmt->bind_param("sssssss", $fname, $lname, $email, $pass, $title, $phone, $carrier);
           $stmt->execute();

           $result1 = mysqli_query($conn,"SELECT * FROM students WHERE email='" . $_POST["email"] . "'");
           $row=mysqli_fetch_array($result1);
           $userid=$row['user_id'];

           header('Location: ./verify-text-student.php?user_id=' .$userid);

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

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->
                <li><a class="navlink" href="./login-student.php">student login</a> </li>
                <li>
                    <a class="navlink" href="../index.html">home</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <h1 class="modal-title welcome-page-title">Student Sign Up</h1>
    <br>
    <div id="tutor_signup_div">
        <form method="post" action="">
            <label>Fields marked * must be filled in order to create an account.</label>
            <br>
            <div class="message">
    
                <?php 
                if($message!="") { 
                    echo $message; 
        
                    } ?> 
            </div> 

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
            <label for="password">Confirm Password *</label>
            <input class="sign_up_input" type="password" id= "paswd2" name="paswd2">
            <label for="level">Current Educational Level *</label>
            <select class="sign_up_input" name="title" id= "title">
                <option selected="choose one"></option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Graduate">Graduate</option>
                <option value="Postgraduate">Postgraduate</option>
            </select>
            <label for="phoneNumber">10 digit US Phone Number *</label>
            <input class="sign_up_input" type="text" id= "phone" name="phone">

            <label for="carrier">Phone Carrier *</label>

            <select class="sign_up_input" name="carrier" id= "carrier">
                <option selected="choose one"></option>
                <option value="AT&T">AT&T</option>
                <option value="Boost Mobile">Boost Mobile</option>
                <option value="Cricket">Cricket</option>
                <option value="Consumer Cellular">Consumer Cellular</option>
                <option value="C-Spire">C-Spire</option>
                <option value="Google Fi">Google Fi</option>
                <option value="Metro PCS">Metro PCS</option>
                <option value="Mint Mobile">Mint Mobile</option>
		        <option value="Page Plus">Page Plus</option>
                <option value="Republic Wireless">Republic Wireless</option>
                <option value="Simple Mobile">Simple Mobile</option>
		        <option value="Sprint">Sprint</option>
                <option value="Ting">Ting</option>
                <option value="Tracfone">Tracfone</option>
                <option value="U.S. Cellular">U.S. Cellular</option>
		        <option value="Verizon">Verizon</option>
		        <option value="Virgin Mobile">Virgin Mobile</option>
		        <option value="Visible">Visible</option>
		        <option value="Xfinity Mobile">Xfinity Mobile</option>

            </select>

            
            <input type="submit" id="tutor_signup_submit" value= "Verify"> 
            <br><br><br>
        </form>

            <!-- <button class="selectButton" onclick="window.location.href = './tutorprofile.html';">Submit</button> -->
    </div>
    <script src="../index.js"></script>

    </body>
    </html>

