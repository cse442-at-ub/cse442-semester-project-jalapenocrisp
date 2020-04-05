  
<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>UB Tutoring Service</title>
</head>

<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->

                <li><a class="navlink" href="./index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <div class="profile">
        <div class="photo">
            <input type="file" accept="image/*">
            <div class="photo__helper">
                <div class="photo__frame photo__frame--circle">
                    <!-- <canvas class="photo__canvas"></canvas> -->
                    <div class="message is-empty">
                        <p class="message--desktop">Drop your photo here or browse your computer.</p>
                        <p class="message--mobile">Tap here to select your picture.</p>
                    </div>
                    <div class="message is-loading">
                        <i class="fa fa-2x fa-spin fa-spinner"></i>
                    </div>
                    <div class="message is-dragover">
                        <i class="fa fa-2x fa-cloud-upload"></i>
                        <p>Drop your photo</p>
                    </div>
                    <div class="message is-wrong-file-type">
                        <p>Only images allowed.</p>
                        <p class="message--desktop">Drop your photo here or browse your computer.</p>
                        <p class="message--mobile">Tap here to select your picture.</p>
                    </div>
                    <div class="message is-wrong-image-size">
                        <p>Your photo must be larger than 350px.</p>
                    </div>
                </div>
            </div>

           
        </div>
    </div>

    <button type="button" id="previewBtn">Preview</button>
    <button type="button" id="uploadBtn">Upload Example</button>

    
    <h1 class="welcome-page-title"></h1>
    <table class="info">

    <?php
    $row = mysqli_fetch_array($result);
    ?>
    <tr><td>Name: </td><td><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></td></tr>
    <tr><td>Phone Number: </td><td><?php echo $row["phone"]; ?></td></tr>
    <tr><td>Title: </td><td><?php echo $row["title"]; ?></td></tr>
    <tr><td>Email: </td><td><?php echo $row["email"]; ?></td></tr>
    <tr><td>Course: </td><td><?php echo $row["courses"]; ?></td></tr>
    <tr><td class="score" title="The number of tutoring hours this tutor has completed.">Score: </td><td><?php echo $row["score"]; ?></td></tr>
    
    </table>
    <button class="selectButton" onclick="window.location.href ='./update-tutor-profile.php?user_id=<?php echo $row['user_id']; ?>';">Edit Information</button>  
    
    <button class="delButton" onclick="window.location.href ='./delete-profile.php?user_id=<?php echo $row['user_id']; ?>';">Delete Profile</button> 
    <br><br><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        
    </script>

</body>

</html>