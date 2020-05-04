<?php
   include_once "access-db.php";

   $sql = "SELECT fname, lname, email, rank, courses FROM tutors ORDER BY rank DESC";
   $result = $conn->query($sql);

    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content ="width=device-width,initial-scale=1,user-scalable=yes" />
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
    
    <title>UB Tutoring Service</title>
</head>

<body class="main-container">

    <div class="header">

        <div class="menu_welcomePage">
            <ul>

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.php')">login</a> </li> -->
                
                <li><a class="navlink" href="index.html">logout</a> </li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <hr class="hr-navbar">

    
    


    <h1 class="modal-title welcome-page-title">List of UBTutoring tutors sorted by rating </h1>
<br><br>
    <div class="list-of-tutors-table">

    
    <?php

        if ($result->num_rows > 0) {
            echo "<table class='tutortable'><tr style='height: 80px'><th style='text-align:left'>first name </th><th style='text-align:left'>last name</th><th style='text-align:left'>email</th><th style='text-align:left'>rating</th><th style='text-align:left'>course</th></tr><br><br>";
            // output data of each row
            while($row = mysqli_fetch_array($result)) {
                echo "<tr style='height: 40px'>
                    <td>" .$row["fname"]. "</td>
                    <td>" . $row["lname"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>". $row["rank"]. "</td>
                    <td>" .$row["courses"]. "</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    ?>
<br><br><br><br><br><br>
</div>

    <!-- add login for the professor -->
        
</body>

</html>
