<?php
include_once "access-db.php";
if (isset($_POST['message'])){
    if ($_POST['message']){
        $name='admin: ';
        $separator='%%%';
        $id=0;
        $message=$name.$_POST['message'].$separator;
        $result = mysqli_query($conn,"SELECT * FROM admin WHERE id=0");
        $row= mysqli_fetch_array($result);
        $chat=$row['chat'];
        $chat.=$message;
        mysqli_query($conn,"UPDATE admin SET chat='" . $chat . "' WHERE id='" . $id . "'"); 
        header('Refresh: 0');   
    }
}

// $result = mysqli_query($conn,"SELECT * FROM admin WHERE id=0");
// $row = mysqli_fetch_array($result);
// $chat= $row['chat'];
// $chatarray=explode('%%%',$chat);

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content ="width=device-width,initial-scale=1,user-scalable=yes" />
    <title>UB Tutoring</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>UB Tutoring Service</title>

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

                    // document.getElementById("ajax-self").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "refresh-chat.php", true);
            xmlhttp.send();
        }

        function sendFormData(){
            const formElement=document.getElementById("myf");
            const formData = new FormData(formElement);
            document.getElementById("myf").reset();
            const request= new XMLHttpRequest();
            request.onreadystatechange = function(){
                if (this.readyState ===4 && this.status ===200){
                    console.log(this.responseText);
                    document.getElementById("chat").innerHTML=this.responseText;
                }
            };
            request.open("POST", "/form-path");
            request.send(formData);
}
    </script>
</head>

<body onload="setInterval(refreshchat,1000)">
    <div class="header">
        <div class="menu_welcomePage">
            <ul>
                <li><a class="navlink" href="./index.html">logout</a> </li>
            </ul>
        </div>

        <div class="logo">
            <h2 class="logo"> <a href="./index.html">UBtutoring</a> </h2>
        </div>
    </div>
    <hr class="hr-navbar">

    <br>
    <h1 class="welcome-page-title">Chatting with user: </h1>
    <br><br>
    <div style="width: 50%; margin-left: auto; margin-right: auto;">
    <form method="post" action="">
            <input class="log_in_input" type="text" id="message" name="message" placeholder="say something to the user"/>
    </form>

    </div>
    <div id="cont" class="cont">
        <p id="ajax-self"></p>

        <!-- <div class="chat-container">
            <div class="talk-bubble-self round ">
                <div class="talktext">
                    <p id="ajax-self"></p>
                </div>
            </div>
        </div><br>

        <div class="chat-container">
            <div class="talk-bubble-other round ">
                <div class="talktext">
                    <p id="ajax-other"></p>
                </div>
            </div>
        </div><br> -->
    </div>   
    <form method="post" action="">
        <input class="selectButton" type="submit" name="exit" id="exit" value="exit chat"/>
    </form>
    <br>
    <br>



</body>


</html>
