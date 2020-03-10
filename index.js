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

function log_me_in(){
    // var log_in_button = Document.getElementById("log_in_button")
    window.open("./tutorprofile.html", "_self");
    //./tutorprofile.html
}

function goToLogIn(){
    window.open("login.html", "_self");
}

function forgot_password(){
    window.open("login.html", "_self");
}


function calenderTutorPopupClose(){
    document.getElementById("day_popup").style.display = "none";
    console.log("here");
}

function calenderTutorPopupOpen(){
    document.getElementById("day_popup").style.display = "flex";
    console.log("here");
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
}