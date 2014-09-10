//So you managed to find the JavaScript!
//Some of the magic happens here, but not alot.
//The real stuff happens server-sided, buddy.
//Sorry!

//Wanna know more or hire me?
//Email me at
//info@bobdesaunois.com

var me;
var getMe = function() { alert(me); };

$(document).ready(function() {
    var w = 0;

        $("#go-to-app").click(function() {
           FB.getLoginStatus(function(response) {
               if(response.status == "connected") {
                   
                   window.location = "do-login.php";
               } else if(response.status == "not_authorized") {
                   window.location = "?notification=Please authorize.";
               } else {
                   window.location = "?notification=Please, make sure you are logged into facebook.";
               }
           }, {scope: 'email,publish_actions'});
        });

    //dis b shiny!
    $("#main").fadeIn({duration: 800, queue: false});
    //+ 20 at the end is a center fix
    $("#main").animate({"marginLeft": (window.innerWidth / 2) - (($("#main").width() / 2) + 20)},
    {duration: 800, queue: false});

    //This makes sure everything looks sexy
    setTimeout(function() {
        var adjust = setInterval(function() {
            if (w != window.innerWidth) {

                if (window.innerWidth > $("#main").width()) {
                    //+ 20 at the end is a center fix
                    $("#main").animate({"marginLeft": (window.innerWidth / 2) - (($("#main").width() / 2) + 20)},
                    {duration: 500, queue: false});

                    w = window.innerWidth;

                } else {
                    $("#main").animate({"marginLeft": 10},
                    {duration: 500, queue: false});
                }

                w = window.innerWidth;
            }
        }, 1000);
    }, 2000);

    window.addEventListener("keyup", function(event) {
        if (event.keyCode === 192)
//            alert(window.innerWidth + " " + w);
        FB.getLoginStatus(function(response) {
           if(response.status == "connected") {
               console.log("Yay!");
           } else if(response.status == "not_authorized") {
               console.log("Nay, authorize!");
           } else {
               console.log("Nay, login!");
           }
        });
    }, false);


    setTimeout(function() {
        $("#response").slideUp();
    }, 7000);

});