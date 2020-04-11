<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM tutors WHERE user_id='" . $_GET['user_id'] . "'");
$row = mysqli_fetch_array($result);
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
                <li><a class="navlink" href="./index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    <form method="POST" action=" " enctype="multipart/form-data">
        <input type="file" name="myimage">
        <input type="submit" name="submit_image" value="Upload">
    </form>

    <?php
     echo '<img class="profilePicture" src="data:image/jpeg;base64,'.base64_encode( $row['user_image'] ).'"/>';


    ?>


    <button class="calendarView" onclick="window.location.href = './tutorCalendarView.html';">Calendar View</button>

    <h1 class="welcome-page-title"></h1>
    <table class="info">

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

<?php
include_once 'access-db.php';

if(count($_POST)>0) {
    $userid=$_GET['user_id'];
    //$userid=1;
    $imagename=$_FILES["myimage"]["name"]; 
    //Get the content of the image and then add slashes to it 
    $imagetmp=addslashes (_POSTfile_get_contents($_FILES['myimage']['tmp_name']));

    //Insert the image name and image content in image_table
    //$insert_image="INSERT INTO tutors (user_image, img_name) VALUES('$imagetmp','$imagename')";

    $insert_image = "UPDATE tutors SET user_image='$imagetmp', img_name='$imagename' WHERE user_id='" . $_GET['user_id'] . "'" ;

    if ($conn->query($insert_image) === TRUE) {
        echo "this is the " .$userid.".";
        echo "new";
        echo "New record created successfully. Naviagate back to see your image";
        echo "";
        echo '<p><a href="tutorprof.php">Back to tutorprof.php</a>';
    } else {
        echo "Error: " . $insert_image . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
