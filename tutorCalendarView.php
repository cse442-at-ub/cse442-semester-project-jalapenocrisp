<?php
    include_once "access-db.php";
    $tutorID = $_GET['user_id'];
    $post_change = array();
    foreach($_POST as $key => $value){
        $v = 0;
        $val = "-";
        if(strcmp( $value , "-") == 0){
            $v = 1;
        }
        $query1 = "UPDATE calendar SET $key = $v WHERE user_id=$tutorID ;";
        mysqli_query($conn, $query1);
    }
    $result = mysqli_query($conn,"SELECT * FROM calendar WHERE user_id='" . $_GET['user_id'] . "'");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <title>UB Tutoring Service</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- <script type="text/javascript" src="js/modernizr.custom.86080.js"></script> -->
</head>


<body>

    <div class="header">
        
        <div class="menu_welcomePage">
            <ul>

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                <li><a class="navlink" href="./index.html">logout</a> </li>

            </ul>
        </div>
           
        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
        
    </div>
    <hr class="hr-navbar">


    <h1 class = "welcome-page-title">Your Availability</h1>
    <form method="post">
        <table id="calendar_tutor" rules="all">
            <thead>
                <tr>
                    <th>
                        <span>------</span>
                    </th>
                    <th>
                        <span id="calendar_monday">Monday</span>
                    </th>
                    <th>
                        <span id="calendar_tuesday">Tuesday</span>
                    </th>
                    <th>
                        <span id="calendar_wednesday">Wednesday</span>
                    </th>
                    <th>
                        <span id="calendar_thursday">Thursday</span>
                    </th>
                    <th>
                        <span id="calendar_friday">Friday</span>
                    </th>
                    <th>
                        <span id="calendar_saturday">Saturday</span>
                    </th>
                    <th>
                        <span id="calendar_sunday">Sunday</span>
                    </th>
                </tr>
            </thead>

            <tbody id=calender_tutor_body>
                <?php
                    $items = array();
                    $columns = array();
                    $calendar = array();
                    $count  = mysqli_num_rows($result);

                    function getUpdateQuery($cal){
                        $update_query = "UPDATE calendar SET ";
                        foreach($cal as $key => $val){
                            $update_query  .= "{$key} = '{$value}', ";
                        }
                        $update_query .= "WHERE user_id=$tutorID ;";
                        return $update_query;
                    }

                    if($count==0) {
                        echo"failed";
                    } else {
                        $items = mysqli_fetch_row($result);
                        $res = mysqli_query($conn, "SHOW COLUMNS FROM cse442_542_2020_spring_teami_db.calendar");
                        
                        while($row = mysqli_fetch_assoc($res)){ // iterate over the result-set object to get all data
                            array_push($columns , $row["Field"]);
                        }
                        $calendar = array_combine($columns, $items);

                        $time = 9;
                        
                        for($i = 1; $i < 14; $i++){
                            echo "<tr> <td>$time</td>";
                            $time++;
                            for($j= 0; $j < 7; $j++){
                                $k = ($j * 13) + $i + 1; 
                                $color = "transparent";
                                $v = "-";
                                if($items[$k] == 1){
                                    $color = "#00334d";
                                    $v = "--";
                                }
                                echo "<td style=\" background-color: $color;\"><input type=submit name=$columns[$k] style=\"width:100%; height:100%; background: transparent; border: none;\" value=\"$v\"></td>";

                            }
                            echo "</tr>";
                        }
                        
                    }
                    

                ?>
            </tbody>
        </table>
    </form>
    
    <form style="width: 100%; text-align: center; ">
        <button id="popup_open" class="add-or-edit-button" type="submit"> My Appointments </button>
    </form>
    <script src="index.js"></script>
    
</body>

</html>
