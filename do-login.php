<?php
require_once("config.php");

global $facebook;
$user_id = $facebook->getUser();
$user_profile = $facebook->api("/me", "GET");

if(User::exists($user_id)) {
    User::login();
} else {
    User::create($user_id, $user_profile["name"]);
}
?>