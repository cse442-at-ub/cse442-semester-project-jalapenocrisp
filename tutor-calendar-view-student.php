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
                <li><a class="navlink" href="./search.php?user_id=<?php echo $_GET['user_id']; ?>">find a tutor</a> </li>
                <li><a class="navlink" href="./studentprof.php?user_id=<?php echo $_GET['user_id']; ?>">profile</a> </li>
                <li><a class="navlink" href="./index.html">logout</a> </li>

            </ul>
        </div>
           
        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
        
    </div>
    <hr class="hr-navbar">

    <h1 class = "welcome-page-title">Appointment Slots<br><br></h1>
    <a class="center" href="./tutorprof-student.php?user_id=<?php echo $_GET['user_id'];?>&tutor_id=<?php echo $_GET['tutor_id'];?>">back to profile</a>
    <table id=calendar_tutor rules="all">
        <thead>
            <tr>
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

        <tbody>
            <br>
            <br>
            <tr>
                <br>
            </tr>
            <tr>
                <td id="calendar_monday_data"></td>
                <td id="calendar_tuesday_data"></td>
                <td id="calendar_wednesday_data"></td>
                <td id="calendar_thursday_data"></td>
                <td id="calendar_friday_data"></td>
                <td id="calendar_saturday_data"></td>
                <td id="calendar_sunday_data"></td>
            </tr>
        </tbody>
    </table>
    
    <div id= "day_popup" class= "day_popup">
        <div class = "day_popup_content">
            <img src="close.png" alt="X" class="day_close" id="day_close"/>
            <label for="monday_data">Monday:</label>
            <input id="monday_data" type="text" placeholder= "ex. 10:30 - 13:30">
           
            <label for="tuesday_data">Tuesday:</label>
            <input id="tuesday_data" type="text" placeholder= "ex. 10:30 - 13:30">
            
            <label for="wednesday_data">Wednesday:</label>
            <input id="wednesday_data" type="text" placeholder= "ex. 10:30 - 13:30">
            
            <label for="thursday_data">Thursday:</label>
            <input id="thursday_data" type="text" placeholder= "ex. 10:30 - 13:30">
            
            <label for="friday_data">Friday:</label>
            <input id="friday_data" type="text" placeholder= "ex. 10:30 - 13:30">
            
            <label for="saturday_data">Saturday:</label>
            <input id="saturday_data" type="text" placeholder= "ex. 10:30 - 13:30">
            
            <label for="sunday_data">Sunday:</label>
            <input id="sunday_data" type="text" placeholder= "ex. 10:30 - 13:30">
            <button id="day_popout_button" onclick="addAvailability()"> Submit </button>
        </div>
    </div>
    

    
    <div><p><br><br><br><br><br><br><br></p>
    </div>

    <script src="index.js"></script>
    <script>
        document.getElementById("day_close").addEventListener("click", calenderTutorPopupClose);
        document.getElementById("popup_open").addEventListener("click", calenderTutorPopupOpen);
    </script>
  
</body>

</html>