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
