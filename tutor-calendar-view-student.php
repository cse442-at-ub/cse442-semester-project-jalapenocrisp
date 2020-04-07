<?php
include_once "access-db.php";
$res = mysqli_query($conn,"SELECT * FROM calendar WHERE user_id='" . $_GET['tutor_id'] . "'");
$r=mysqli_fetch_array($res);
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

    <h1 class = "welcome-page-title">Appointment Slots</h1>
    <a class="center" href="./tutorprof-student.php?user_id=<?php echo $_GET['user_id'];?>&tutor_id=<?php echo $_GET['tutor_id'];?>">back to profile</a>
    <br><br>
    <table id=calendar_tutor rules="all">
            <tr style="height: 40px">
                <th>
                    <span id="calendar_monday"></span>
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
            <tr style="height: 40px"><td>9:00AM</td>
                <td ><?php if ($r['mon9']==1){ echo "<button class='cancel'>claim</button>";} else{ echo"- - - - - - -";}?></td>
                <td><?php if ($r['tue9']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed9']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu9']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri9']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat9']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun9']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>10:00AM</td>
            <td><?php if ($r['mon10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun10']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>11:00AM</td>
                <td><?php if ($r['mon11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun11']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>12:00PM</td>
                <td><?php if ($r['mon12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun12']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>1:00PM</td>
                <td><?php if ($r['mon13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun13']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>2:00PM</td>
                <td><?php if ($r['mon14']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue14']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed14']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu14']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri14']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat14']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun14']==1){ echo "<button class='cancel'>claim</button>";}?></td></td>
            </tr>
            <tr style="height: 40px"><td>3:00PM</td>
                <td><?php if ($r['mon15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun15']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>4:00PM</td>
                <td><?php if ($r['mon16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun16']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>5:00PM</td>
                <td><?php if ($r['mon17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun17']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>
            <tr style="height: 40px"><td>6:00PM</td>
                <td><?php if ($r['mon18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun18']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>            
            <tr style="height: 40px"><td>7:00PM</td>
                <td><?php if ($r['mon19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun19']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>            
            <tr style="height: 40px"><td>8:00PM</td>
                <td><?php if ($r['mon20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun20']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>            
            <tr style="height: 40px"><td>9:00PM</td>
                <td><?php if ($r['mon21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['tue21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['wed21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['thu21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['fri21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sat21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
                <td><?php if ($r['sun21']==1){ echo "<button class='cancel'>claim</button>";}?></td>
            </tr>

    <script src="index.js"></script>
    <script>
        document.getElementById("day_close").addEventListener("click", calenderTutorPopupClose);
        document.getElementById("popup_open").addEventListener("click", calenderTutorPopupOpen);
    </script>
  
</body>

</html>
