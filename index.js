function loadPage(suburl, data, callback, postcallback) {
    $.ajax({
        url: suburl,
        type: "GET",
        data: data,
        success: function(maindta) {
            if (callback) {
                callback(maindta);
            } else {
                document.getElementById("pageDetails").innerHTML = maindta;
                if (postcallback) {
                    postcallback();
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var message = "ERROR:" + errorThrown;
            alert(errorThrown);
        }
    });
}


function goToLogIn(){
<<<<<<< HEAD
    window.open("login.php", "_self");
}

function forgot_password(){
    window.open("login.php", "_self");
}

function calenderTutorPopupClose(){
    document.getElementById("day_popup").style.display = "none";
}

function calenderTutorPopupOpen(){
    document.getElementById("day_popup").style.display = "flex";
}

function changeAvailibility(mon, tue, wed, thu, fri, sat, sun){
    var monday = document.getElementById("calendar_monday_data");
    var tuesday = document.getElementById("calendar_tuesday_data");
    var wednesday = document.getElementById("calendar_wednesday_data");
    var thursday = document.getElementById("calendar_thursday_data");
    var friday = document.getElementById("calendar_friday_data");
    var saturday = document.getElementById("calendar_saturday_data");
    var sunday = document.getElementById("calendar_sunday_data");

    
        monday.innerHTML = mon;
    
    
        tuesday.innerHTML = tue;
    
   
        wednesday.innerHTML = wed;
   
   
        thursday.innerHTML = thu;
   
   
        friday.innerHTML = fri;
   
   
        saturday.innerHTML = sat;
   
   
        sunday.innerHTML = sun;
   

    console.log("here1");
    
}

function addAvailability(){
    console.log("here");
    var mon = document.getElementById("monday_data").value;
    var tue = document.getElementById("tuesday_data").value;
    var wed = document.getElementById("wednesday_data").value;
    var thu = document.getElementById("thursday_data").value;
    var fri = document.getElementById("friday_data").value;
    var sat = document.getElementById("saturday_data").value;
    var sun = document.getElementById("sunday_data").value;
    changeAvailibility(mon, tue, wed, thu, fri, sat, sun);
    calenderTutorPopupClose();
=======
    window.open("login.html", "_self");
}

function forgot_password(){
    window.open("login.html", "_self");
}

function verifyInfo(fname, lname, emailEntered, inputtxt){
    if(fname.value == "" || lname.value == ""){
        alert("Name fields must not be empty!")
    }else{
        var emails = emailEntered.value;

        if(emails.length != 20){
            alert("Please enter valid UB email length: \nUB Email length: 20 \nYour email length: " + emails.length)
        }else{
            var address = emails.slice(9,20); 
            var emailName = emails.split("@buffalo.edu", 1);
        
            if(emailName[0].length != 8 || address != "buffalo.edu"){
                alert("Please enter valid UB email! \nUB Email: example9@buffalo.edu\n \texamples@buffalo.edu\nYour email: " + emailName)
            }else{
                var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
                if(inputtxt.value.match(decimal)){ 
                    alert('All information is valid')
                    window.open("login.html", "self");
                }
                else{ 
                    alert('Password must be 8 to 15 characters long and have at least 1 uppercase and lowercase letter, 1 number, and 1 special character.' )
                }
            }  
        } 
    }
>>>>>>> 961210311904361052dd274e4c9ff68d8781e946
}
function verifyInfo(fname, lname, emailEntered, inputtxt){
    if(fname.value == "" || lname.value == ""){
        alert("Name fields must not be empty!")
    }else{
        var emails = emailEntered.value;
        
        if(emails.length != 20){
            alert("Please enter valid UB email length: \nUB Email length: 20 \nYour email length: " + emails.length)
        }else{
            var address = emails.slice(9,20); 
            var emailName = emails.split("@buffalo.edu", 1);
             
            if(emailName[0].length != 8 || address != "buffalo.edu"){
                alert("Please enter valid UB email! \nUB Email: example9@buffalo.edu\n \texamples@buffalo.edu\nYour email: " + emailName)
            }else{
                var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
                if(inputtxt.value.match(decimal)){ 
                    alert('All information is valid')
                    window.open("login.php");
                }
                else{ 
                    alert('Password must be 8 to 15 characters long and have at least 1 uppercase and lowercase letter, 1 number, and 1 special character.' )
                }
            }  
        } 
    }
}
