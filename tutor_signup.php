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
            <label>[8-15 characters, at least 1 upper & lowercase letter, 1 special character, and 1 number are required]</label>
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
                <option value="CSE368">CSE368</option>
                <option value="CSE370">CSE370</option>
                <option value="CSE396">CSE396</option>
                <option value="CSE474">CSE474</option>
                <option value="CSE487">CSE487</option>
                <option value="CSE489">CSE489</option>


            </select>

            <label for="phoneNumber">US Phone Number</label>
            <input class="sign_up_input" type="text" id= "phone" name="phone" placeholder="555-555-5555">
            <input type="submit" id="tutor_signup_submit" onclick="verifyInfo(fname, lname, email, paswd, phone);" value= "Verify"> 
            <br><br><br>
        </form>

            <!-- <button class="selectButton" onclick="window.location.href = './tutorprofile.html';">Submit</button> -->
    </div>
    <script src="index.js"></script>
    <script>
        function verifyInfo(fname, lname, email, pw, phone){
        if(fname.value == "" || lname.value == ""){
            alert("Name fields must not be empty!");
        }else if(phone.length!=12){
            alert("Please input phone number as 555-555-5555.");
        }else{
            var emails = email.value;
            if ((!emails.includes('@buffalo.edu')) || emails.length<13){
                alert("Please enter a valid UB email address.");
            }else{
                var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
                if(pw.value.match(decimal)){ 
                    <?php
                        include_once "access-db.php";
                        $fname=$_POST['fname'];
                        $lname=$_POST['lname'];
                        $email=$_POST['email'];
                        $phone=$_POST['phone'];
                        $title=$_POST['title'];
                        $courses=$_POST['courses'];                        
                        $pass=$_POST['paswd'];

                        $sql = "INSERT INTO tutors (fname, lname, email, phone, title, courses, paswd) VALUES (?,?,?,?,?,?,?)";
                        $stmt= $conn->prepare($sql);
                        $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $title, $courses, $pass);
                        $stmt->execute();
                      
                    ?>
                    window.open("login.php", "self");
                }
                else{ 
                    alert('Password must be 8 to 15 characters long and have at least 1 uppercase and lowercase letter, 1 number, and 1 special character.' )
                }  
            } 
        }
    }
</script>
</body>
</html>