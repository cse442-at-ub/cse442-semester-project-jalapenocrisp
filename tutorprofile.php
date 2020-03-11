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

                <!-- the line of code commented below is important when we upload the work on a server. for now, i'm using an alternative below -->
                <!-- <li><a href="javascript:loadPage('./login.html')">login</a> </li> -->
                <li><a href="./login.html">login</a> </li>
                <li>
                    <a href="./index.html">home</a> </li>
                <li>create account</li>

            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>

    </div>
    <?php
      
        if(isset($_POST['changeTitle'])) { 
            echo "This is changeTitle that is selected"; 
        } 

    ?> 
    <button class="calendarView" onclick="window.location.href = './tutorCalendarView.html';">Calendar View</button>

    <h1 class="welcome-page-title">Jane Doe</h1>
    <img src="https://cdn11.bigcommerce.com/s-sq9zkarfah/images/stencil/1280x1280/products/115789/203691/Girl-Stick-Figure-36-Sticker__96720.1511164309.jpg?c=2?imbypass=on" alt="HTML5 Icon" style="width:180px;height:180px;" class="center">
    <table class= "info" id="profTable">
        <tr>
            <th>Title: </th>
            <td contentEditable="true">Undergraduate</td>
            <td><form method="post"><input type="submit" name="changeTitle" value="save changes"></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td contentEditable="true">janedoe123@buffalo.edu</td>
            <td><button class="change" onclick="changeEmail();">save changes</button></td>
        </tr>
        <tr>
            <th>Major:</th>
            <td contentEditable="true">Computer Engineering</td>
            <td><button class="change" onclick="changeMajor();">save changes</button></td>
        </tr>        
        <tr>
            <th>Tutors in:</th>
            <td contentEditable="true">CSE 115, CSE 250</td>
            <td><button class="change" onclick="changeClasses();">save changes</button></td>

        </tr>        
        <tr>
            <th>Designated Tutoring Location:</th>
            <td contentEditable="true">Lockwood 1st Floor</td>
            <td><button class="change" onclick="changeMeetingArea();">save changes</button></td>

        </tr>        
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="index.js"></script>
    <script>
        var majors= ["Computer Science", "Mathematics", "Undecided", "Art", "Biology", "Chemistry", "Physics"];
        var classes= ["CSE 115","CSE 116", "CSE 250", "MTH 142", "CSE 331", "PHY 207"];
        var profileTable=document.getElementById('profTable');

        function changeTitle(){
            var title=profileTable.rows[0].cells[1].innerHTML;
            if (title!= "Undergraduate" && title!= "Graduate" && title!= "Postgraduate" ){
                alert("please enter a valid title: Undergraduate, Graduate or Postgraduate.");
            }else{
                updateDb.php("title", title);
            }
            //now get the updated value on change and add to DB
        }

        function changeClasses(){
            var c=profileTable.rows[3].cells[1].innerHTML;
            classList=c.split(', ');
            for (i=0; i<classList.length; i++){
                if (!classes.includes(classList[i])){
                    alert("One or more of the chosen classes is invalid. Make sure each class is separated by a comma and a space. Please choose classes from the following list:\n\nCSE 115\nCSE 116\nCSE 250\nCSE 331\nMTH 142\nPHY 207");
                }else{
                    updateDb.php("classes", classList);

                }
            //now get the updated value on change and add to DB
            }
        }

        function changeEmail(){
            var email=profileTable.rows[1].cells[1].innerHTML;
            if (!email.includes("@buffalo.edu")){
                alert("Please enter a valid UB email address including '@buffalo.edu'");
            }else{
                updateDb.php("email", email);
              }
            //now get the updated value on change and add to DB
        }
        
        function changeMajor(){
            var major=profileTable.rows[2].cells[1].innerHTML;
            if (!majors.includes(major)){
                alert("Please enter a valid major from the list:\n\nComputer Science\nMathematics\nUndecided\nArt\nBiology\nChemistry\nPhysics");
            }else{
                updateDb.php("major", major);

            }
            
            //now get the updated value on change and add to DB
        }
        
        function changeMeetingArea(){
            var meeting=profileTable.rows[0].cells[1].innerHTML;
            //if (title!= "Undergraduate" && title!= "Graduate" && title!= "Postgraduate" ){
            //    alert("please enter a valid title: Undergraduate, Graduate or Postgraduate.");
            //} 
            //now get the updated value on change and add to DB
        }  
        
    </script>

</body>

</html>
