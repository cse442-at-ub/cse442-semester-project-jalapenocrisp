<?php
    include_once "access-db.php";

    if(count($_POST)>0) {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $title=$_POST['title'];
        $courses=$_POST['courses'];                        
        $pass=$_POST['paswd'];

        $result = mysqli_query($conn,"SELECT * FROM tutors WHERE email='" . $_POST["email"] . "'");
        $count  = mysqli_num_rows($result);


        if (strlen($phone)!=12){
            echo'<script>alert("Please input phone number as 555-555-5555.")</script>';
        }else if ((strpos( $email, '@buffalo.edu' ) === false)){
            echo'<script>alert("Please enter a valid UB email address.")</script>';
        }else if($count>0){
            echo'<script>alert("Email address is already in use.")</script>';
        }else if(empty($fname) || empty($lname)){
            echo'<script>alert("Please enter a first and last name.")</script>';
        }else if(!preg_match('^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$', $pass)){
            echo'<script>alert("Please enter a valid password.")</script>';
        }else{
            $sql = "INSERT INTO tutors (fname, lname, email, phone, title, courses, paswd) VALUES (?,?,?,?,?,?,?)";
            $stmt= $conn->prepare($sql);
            $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $title, $courses, $pass);
            $stmt->execute();
            header('Location: ./login.php');
        }
    }
                      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>UB Tutoring -Sign Up</title>
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
    
    <h1 class="welcome-page-title">Sign Up</h1>

    <div id="tutor_signup_div">
        <form method="post" action="">
            <label>Fields marked * must be filled in order to create an account.</label>
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

            <label for="level">Current Educational Level</label>
            <select class="sign_up_input" name="title" id= "title">
                <option selected="choose one"></option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Graduate">Graduate</option>
                <option value="Postgraduate">Postgraduate</option>
            </select>
            
            <label for="expertise">CSE Course to tutor</label>

            <select class="sign_up_input" name="courses" id= "courses">
                <option selected="choose one"></option>
                <option value="CSE115">CSE115</option>
                <option value="CSE116">CSE116</option>
                <option value="CSE220">CSE220</option>
                <option value="CSE250">CSE250</option>
                <option value="CSE305">CSE305</option>
                <option value="CSE306">CSE306</option>
                <option value="CSE321">CSE321</option>
                <option value="CSE331">CSE331</option>
		        <option value="CSE341">CSE341</option>
		        <option value="CSE365">CSE365</option>
                <option value="CSE368">CSE368</option>
                <option value="CSE370">CSE370</option>
		        <option value="CSE379">CSE379</option>
                <option value="CSE396">CSE396</option>
		        <option value="CSE404">CSE404</option>
		        <option value="CSE411">CSE411</option>
		        <option value="CSE421">CSE421</option>
		        <option value="CSE422">CSE422</option>
		        <option value="CSE426">CSE426</option>
		        <option value="CSE429">CSE429</option>
		        <option value="CSE430">CSE430</option>
		        <option value="CSE431">CSE431</option>
		        <option value="CSE432">CSE432</option>
		        <option value="CSE435">CSE435</option>
		        <option value="CSE443">CSE443</option>
		        <option value="CSE445">CSE445</option>
		        <option value="CSE450">CSE450</option>
		        <option value="CSE451">CSE451</option>
		        <option value="CSE453">CSE453</option>
		        <option value="CSE454">CSE454</option>
		        <option value="CSE455">CSE455</option>
		        <option value="CSE460">CSE460</option>
		        <option value="CSE462">CSE462</option>	
		        <option value="CSE463">CSE463</option>
		        <option value="CSE467">CSE467</option>
		        <option value="CSE468">CSE468</option>
		        <option value="CSE469">CSE469</option>
		        <option value="CSE470">CSE470</option>
		        <option value="CSE473">CSE473</option>	
                <option value="CSE474">CSE474</option>
		        <option value="CSE486">CSE486</option>
                <option value="CSE487">CSE487</option>
                <option value="CSE489">CSE489</option>
		        <option value="CSE490">CSE490</option>
		        <option value="CSE491">CSE491</option>
		        <option value="CSE493">CSE493</option>
            </select>

            <label for="phoneNumber">US Phone Number</label>
            <input class="sign_up_input" type="text" id= "phone" name="phone" placeholder="555-555-5555">
            <input type="submit" id="tutor_signup_submit" value= "Verify"> 
            <br><br><br>
        </form>

            <!-- <button class="selectButton" onclick="window.location.href = './tutorprofile.html';">Submit</button> -->
    </div>
    <script src="index.js"></script>

    </body>
    </html>
