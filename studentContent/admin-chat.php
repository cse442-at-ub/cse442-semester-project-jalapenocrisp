<?php
include_once "access-db.php";
if (isset($_POST['message'])){
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
        <div class="menu_welcomePage">
            <ul>
                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $_GET['user_id']; ?>">back to profile</a> </li>             
                    
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">
                   
    <h1 class="welcome-page-title">You are chatting with an admin.</h1>
    <br><br>
    <div class="cont">


        <div class="chat-container">
            <div class="talk-bubble-other round ">
                <div class="talktext">
                    <p>from the file, this is the first message from the admin!</p>
                </div>
            </div>
        </div>

        <div class="chat-container">
            <div class="talk-bubble-self round ">
                <div class="talktext">
                    <p>from the file, this is the first message from me!</p>
                </div>
            </div>
        </div>
    

        <div class="input-narrow bottomtext">
        <form method="post" action="">
            <input class="log_in_input" type="text" id="text" name="message" placeholder="say something to the admin">
        </form>
        </div>  

    </div>      
   

    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script>
    </script>

</body>

</html>
