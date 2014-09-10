<?php

function redirect($string) {
    
    header("Location: " . $string);
    
}

function setNotification($string) {
    
    $_SESSION["response"] = $string;
    
}

function getNotification() {
    
    if($_GET["notification"]) {
        setNotification($_GET["notification"]);
    }
    
    if(notificationIsSet())
        echo "<div id='response'>" . $_SESSION["response"] . "</div>";
        echo "<script>$('#response').slideDown();</script>";
        $_SESSION["response"] = null;
    
}

function notificationIsSet() {
    
    return isset($_SESSION["response"]) ? true : false;
    
}

?>