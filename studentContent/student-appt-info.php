<?php
    include_once "access-db.php";
    $student_id=$_GET['user_id'];
    $tutor_id = $_GET['tutor'];
    $course_arr = mysqli_fetch_array(mysqli_query($conn,"SELECT courses FROM tutors WHERE user_id=$tutor_id"));
    $course = $course_arr['courses'];
    foreach($_POST as $key => $value){
        $v = 0;
        $val = "-";
        if(strcmp( $value , "-") == 0){
            $v = 1;
        }
        $query1 = "UPDATE calendar SET $key = $v WHERE user_id=$tutorID ;";
        mysqli_query($conn, $query1);
    }
    if(count($_POST) > 0){
        $allClasses = "";
        foreach($_POST as $key => $value){
            if($value <=100 && $value >= 0){
                $allClasses .= $value .",";
            }
        }
        if(strlen($allClasses) > 7){
            for($i = 0; $i < 8; $i++){
                $allClasses = substr_replace($allClasses ,"",-1);
            }
        }
       

        $sql_query = "INSERT INTO progress (id, student_id, course, grades) VALUES (?, $student_id, $course, $allClasses)";
        mysqli_query($conn, $sql_query);
        header('Location: student-appts.php?user_id=' . $student_id);
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css" >
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    

    <title>Document</title>
</head>
<body>
    <h1>Tell us about your previous exam/text/home-work grades from CSE-331</h1>
    <div >
        <form action="post">
            
            <select id="num_of_exams">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
            </select>
            <div id="all_classes_input">

            </div>
            <input type="submit" name="submit">
        </form>
    </div>
    <script src="../index.js"></script>
</body>
</html>