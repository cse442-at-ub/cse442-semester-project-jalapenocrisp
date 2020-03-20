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

    if(!(mon === "")){
        monday.innerHTML = mon;
    }
    if(!(tue === "")){
        tuesday.innerHTML = tue;
    }
    if(!(wed === "")){
        wednesday.innerHTML = wed;
    }
    if(!(thu === "")){
        thursday.innerHTML = thu;
    }
    if(!(fri === "")){
        friday.innerHTML = fri;
    }
    if(!(sat === "")){
        saturday.innerHTML = sat;
    }
    if(!(sun === "")){
        sunday.innerHTML = sun;
    }

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
}
