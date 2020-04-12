<?php
    include_once "access-db.php";
    $student_id = $_GET['user_id'];
    $result = mysqli_query($conn,"SELECT * FROM progress WHERE student_id=$student_id;");
    
    $all_courses = array();
    while($row = mysqli_fetch_array($result)){
        $course_name = $row["course"];
        array_push($all_courses, $course_name);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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

                <li><a class="navlink" href="./search.php?user_id=<?php echo $row['user_id']; ?>">find a tutor</a> </li>
                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $row['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">



    <?php
        $num_classes = count($all_courses);
        if( $num_classes > 0){
    ?>
    
    <h1 class="welcome-page-title">Your Classes</h1><br>

    <div id="student_appointment_div">
        <form method="post">
        
        <label id="student_appointment_label" for="nextExam"> Choose a Course </label>
            <select name id="num_of_exams">
                
                <?php
                    foreach($all_courses as $key => $value){
                ?>
                <option value=<?php  echo "\"$value\";"?>><?php  echo $value; ?></option>
                
                <?php
                    }
                ?>
            </select>
            <input class="exam_student_input" type="text" onkeypress="validate(event)", name="grade_for_course">
            <input id="student_appt_submit" type="submit" name="submit">

        </form>
    </div>

    <?php
        }else{
    ?>
    <h1 class="welcome-page-title">YOU HAVE NO COURSES OR APPOINTMENTS</h1><br>
    <?php
        }
    ?>


    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../index.js"></script>

<script>

</script>

</body>

</html>

