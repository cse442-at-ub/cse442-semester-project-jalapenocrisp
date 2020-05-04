<?php
include_once 'access-db.php';
if (isset($_POST['submit'])) {
    $userid=$_GET['user_id'];
    if (getimagesize($_FILES['imagefile']['tmp_name']) == false) {
        echo "<br />Please Select An Image.";
    } else {
        $image = $_FILES['imagefile']['tmp_name'];
        $name = $_FILES['imagefile']['name'];
        $image = base64_encode(file_get_contents(addslashes($image)));
        mysqli_query($conn, "UPDATE tutors SET img_name='" . $name . "', user_image='" . $image . "' WHERE user_id='" . $userid . "'");

    }
    header('Location: ./tutorprof.php?user_id=' .$userid);
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
</head>
<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>
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
    <br><br><br>
    <h1 class="modal-title welcome-page-title">Upload a new photo</h1>
    <br><br><br>
    <div class="modal">
        <br><br><br>
        <p> * photo must be jpeg format * </p><br><br>
        <div id="tutor_signup_div">

        <form method="post" action="" enctype="multipart/form-data">
        <div class="modal-input">

            <input type="file" name="imagefile"><br><br>
            <input class="log_in_button" type="submit" name="submit" value="Upload">
        </div>
        </form>
</div>
        <br><br><br>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        
    </script>

</body>

</html>
