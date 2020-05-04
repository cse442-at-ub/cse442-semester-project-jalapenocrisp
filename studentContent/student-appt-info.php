<?php
    include_once "access-db.php";
    $student_id=$_GET['user_id'];
    $tutor_id = $_GET['tutor'];
    $course_arr = mysqli_fetch_array(mysqli_query($conn,"SELECT courses FROM tutors WHERE user_id=$tutor_id;"));
    $course = $course_arr['courses'];

    $incorrect_date = FALSE;
    
    if(count($_POST) > 0){

        $allClasses = "";
        $nextExam_string= $_POST["nextExam_year"] . "-" . $_POST["nextExam_month"] . "-" . $_POST["nextExam_date"];


        $nextExam_date = strtotime($nextExam_string); 
        $nextExam = date('Y-m-d', $nextExam_date); 
        
        unset($_POST["nextExam_month"]);
        unset($_POST["nextExam_year"]);
        unset($_POST["nextExam_date"]);
        unset($_POST["submit"]);

        $todays_date = new DateTime("now", new DateTimeZone('America/New_York') );
        $formatted_todays_date = $todays_date->format('Y-m-d');

        

        if($formatted_todays_date > $nextExam){
            $incorrect_date = TRUE;
        }else{

            $flag = FALSE;
            foreach($_POST as $key => $value){
                if( strlen($value) > 0 && floatval($value) <=100 && floatval($value) >= 0){
                    $allClasses .= $value .",";
                    $flag = TRUE;
                }
            }
            if($flag == TRUE){
                $allClasses = substr_replace($allClasses ,"",-1);
            }
            
            $results = mysqli_query($conn, "SELECT * FROM progress WHERE student_id=$student_id AND course=\"$course\";");
            $count = mysqli_num_rows($results);
            
            $sql_query = "";

            if($count > 0){
                $arr_results = mysqli_fetch_array($results);
                $prev = $arr_results['grades'];
                if($flag == TRUE){
                    $prev .= "," . $allClasses;
                }           
                $sql_query = "UPDATE progress SET grades=\"$prev\", nextExam=\"$nextExam\" WHERE student_id=$student_id AND course=\"$course\" ;";
            }else{
                $sql_query = "INSERT INTO progress (student_id, course, grades, nextExam) VALUES ($student_id, \"$course\", \"$allClasses\", \"$nextExam\");";
            }

            
            mysqli_query($conn, $sql_query);
            header('Location: student-appts.php?user_id=' . $student_id);

        }
        
        
    }

$progress= mysqli_query($conn,"SELECT * FROM progress WHERE student_id='" . $_GET['user_id'] . "'");

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content ="width=device-width,initial-scale=1,user-scalable=yes" />    <link rel="stylesheet" type="text/css" href="../style.css" >
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>UB Tutoring Service</title>
</head>
<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>
                 <li><a class="navlink" href="./student-appts.php?user_id=<?php echo $_GET['user_id']; ?>">my appointments</a> </li>
                    <div class="dropdown">
                    <li><button onclick="progressclick()" class="dropbtn">my progress</button>
                            <div id="myDropdown" class="dropdown-content">
                                <?php 
                                if (mysqli_num_rows($progress)<1){
                                    echo "<p class='center'>no progress yet</p>";
                                }else{
                                while ($progressInfo = mysqli_fetch_array($progress)){ 
                                    $linkname=$progressInfo['course'];
                                    $link="./student-progress.php?user_id=" . $_GET['user_id'] . "&cid=" . $linkname ; 
                                    echo "<a href=".$link.">".$linkname."</a>";}
                                }
                                ?>
                            </div>
                        </li>
                    </div>
                <li><a class="navlink" href="./search.php?user_id=<?php echo $student_id; ?>">find a tutor</a> </li>
                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $student_id; ?>">profile</a> </li>
                <li><a class="navlink" href="../index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">
    <br><br><br><br>
    <div class="modal">
    <h1 class="modal-title welcome-page-title">Enter your most recent grades for <?php echo $course;?></h1><br>
    <p class="center"> *must be in number format*</p>
    <br><br><br>

    
    <?php if($incorrect_date == TRUE){ ?>
        <p class="center">Enter a future date.</p>
    <?php  }?>

    <div id="tutor_signup_div">
    <div class="modal-input">   
        <form method="post">
            
            <select id="num_of_exams">
                <option value="number" selected>number of grades to enter</option>
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
            

            <input id="log_in_button" type="submit" name="submit">
        <br><br><br>
        </form>
    </div>
    </div>
    <script src="../index.js"></script>
</body>
</html>
