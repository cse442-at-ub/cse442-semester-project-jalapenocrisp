<?php
    include_once "access-db.php";
    $student_id=$_GET['user_id'];
    $tutor_id = $_GET['tutor'];
    $course_arr = mysqli_fetch_array(mysqli_query($conn,"SELECT courses FROM tutors WHERE user_id=$tutor_id;"));
    $course = $course_arr['courses'];

    
    if(count($_POST) > 0){

        $allClasses = "";
        $nextExam= $_POST["nextExam_year"] . "-" . $_POST["nextExam_month"] . "-" . $_POST["nextExam_date"] . " 00:00:00";
        unset($_POST["nextExam_month"]);
        unset($_POST["nextExam_year"]);
        unset($_POST["nextExam_date"]);
        unset($_POST["submit"]);
        $flag = FALSE;
        foreach($_POST as $key => $value){
            if( strlen($value) > 0 && floatval($value) <=100 && floatval($value) >= 0){
                $allClasses .= $value .",";
                $flag = TRUE;
            }
        }
        if($flag){
            $allClasses = substr_replace($allClasses ,"",-1);
        }
        
        $results = mysqli_query($conn, "SELECT * FROM progress WHERE student_id=$student_id AND course=\"$course\";");
        $count = mysqli_num_rows($results);
        
        $sql_query = "";

        if($count > 0){
            $arr_results = mysqli_fetch_array($results);
            $prev = $arr_results['grades'];
            $prev .= "," . $allClasses;
            $sql_query = "UPDATE progress SET grades=\"$prev\", nextExam=\"$nextExam\" WHERE student_id=$student_id AND course=\"$course\" ;";
        }else{
            $sql_query = "INSERT INTO progress (student_id, course, grades, nextExam) VALUES ($student_id, \"$course\", \"$allClasses\", \"$nextExam\");";
        }

        
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>UB Tutoring Service</title>
</head>
<body>
    <p align="center" id="student_appt_info_header">Tell us about your previous exams you haven't entered previously for <?php echo $course;?></p>
    <div id="student_appointment_div">
        <form method="post">
            
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

            <label id="student_appointment_label" for="nextExam">Enter the date of your next exam </label>
            <div id="student_appointment_div2">
                <select id="nextExam_month" name="nextExam_month">
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
                </select>
                <select id="nextExam_date" name="nextExam_date">
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="11">11</option>
                    <option value="10">10</option>
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
                    <option value="31">31</option>
                </select>
                <select id="nextExam_year" name="nextExam_year">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>

                </select>
            </div>
            

            <input id="student_appt_submit" type="submit" name="submit">

        </form>
    </div>
    <script src="../index.js"></script>
</body>
</html>