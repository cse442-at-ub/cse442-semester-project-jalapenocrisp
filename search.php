<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT courses FROM tutors");
$courseArray=Array();
while($row=mysqli_fetch_array($result)){
    if (!in_array($row['courses'], $courseArray)){
        $courseArray[]=$row['courses'];

    }
}
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
                <li><a href="./login.php">login</a> </li>
                <li>
                    <a href="./index.html">home</a> </li>
                <li>create account</li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>

    <h1 class="welcome-page-title">Find Your Class: </h1>
    <div class="dd">
    <form method="post">

      <div class="options">

        <select id ="first-choice">
            <option selected="selected">Pick a class</option>
            <?php    
                foreach($courseArray as $item){
            ?>
            <option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
            <?php
                }
            ?>
        </select>
        
        <br>

        <br>

        <select id="second-choice" name="tutor">
            <option selected="selected">Please choose from above</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Submit">
      </div>

    </form>
    <?php
    if(count($_POST)>0) {
        $result = $_POST['tutor'];
        $name=Array();
        $name=explode(" ", $result);
        $fname=$name[0];
        $lname=$name[1];
        $result = mysqli_query($conn,"SELECT * FROM tutors WHERE fname='$fname' and lname = '$lname'");
        $row = mysqli_fetch_array($result);
        $var1=$row['user_id'];
        header('Location: ./tutorprof-student.php?user_id=' .$var1);

        
    }
    ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        $("#first-choice").change(function(){
            $("#second-choice").load("getter.php?choice=" + $("#first-choice").val());
        }).trigger("change");      

    </script>
</body>

</html>
