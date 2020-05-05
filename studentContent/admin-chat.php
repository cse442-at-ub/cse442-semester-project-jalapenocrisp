<?php
include_once "access-db.php";
$result = mysqli_query($conn,"SELECT * FROM students WHERE user_id='" . $_GET['user_id'] . "'");
$row= mysqli_fetch_array($result);
$name=$row['fname']. " " .$row['lname'];

if (isset($_POST['exit'])){
    $chat="";
    $id=0;
    mysqli_query($conn,"UPDATE admin SET chat='" . $chat . "' WHERE id='" . $id . "'"); 
    header('Location: ./studentprof.php?user_id=' .$_GET['user_id']);
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content ="width=device-width,initial-scale=1,user-scalable=yes" />
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="../style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500&family=Noto+Serif:wght@700&family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow&family=Fredericka+the+Great&family=Noto+Serif&family=Roboto&display=swap" rel="stylesheet">
    
    <script>
        function refreshchat() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var div=document.getElementById("cont");
                    var child=div.lastElementChild;
            
                    while (child){
                        div.removeChild(child);
                        child=div.lastElementChild;
                    }
                    var total=this.responseText;
                    var arr=total.split("%%%");
                    var arrLen=arr.length;
                    for (var i=arrLen-1; i>=0; i--){
                        var paragraph=document.createElement("p");
                        var el=document.createTextNode(arr[i]);
                        paragraph.appendChild(el);
                        var d=document.getElementById("cont");
                        d.appendChild(paragraph);
                    }
                }
            };
            xmlhttp.open("GET", "../adminContent/refresh-chat.php", true);
            xmlhttp.send();
        }

        function sendFormData(){
            const formElement=document.getElementById("msg");
            const formData = new FormData(formElement);
            document.getElementById("msg").reset();
            const request= new XMLHttpRequest();
            request.onreadystatechange = function(){
                if (this.readyState ===4 && this.status ===200){
                    console.log(this.responseText);
                    document.getElementById("chat").innerHTML=this.responseText;
                }
            };
            request.open("POST", "send-message-student.php?user=<?php echo $name; ?>");
            request.send(formData);
}
    </script>
</head>

<body onload="setInterval(refreshchat,1000)">
    <div class="header">
        <div class="menu_welcomePage">
            <ul>
                <li><a class="navlink" href="../index.html">logout</a> </li>
            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="../index.html">UBtutoring</a> </h2>
        </div>
    </div>
    <hr class="hr-navbar">

    <br>
    <h1 class="welcome-page-title modal-title">Chatting with Admin: </h1>
    <br><br>
    <div style="width: 60%; margin-left: auto; margin-right: auto;">
    <div class="modal-input">

    <form id="msg" action="" method="post" enctype="multipart/form-data" onsubmit="sendFormData();return false;">
        <input class="log_in_input" type="text" id="message" name="message" placeholder="say something to the admin"/>
    </form>

    </div>
    <div id="cont" class="chatcont">
        <p id="chat"></p>

    </div>   
    </div>

    <form method="post" action="">
        <input class="selectButton" type="submit" name="exit" id="exit" value="exit chat"/>
    </form>

    <br>
    <br>



</body>


</html>
