<?php
if(!isset($_SESSION))
    session_start();

$db_username = "bluebabbleAdmin";
$db_password = "kinetic";

$link = new PDO("mysql:host=localhost;dbname=bluebabble;", $db_username, $db_password);

ini_set("display_errors", "on"); //debug mode

require_once("init.php");

define(APP_NAME, "Bluebabble ALPHA");
define(SLOGAN, "Connect with strangers like yourself");
define(COMPANY, "Ragsmuffin Entertainment");
define(STARTER_BOTTLES, 25);
define(DEBUG_MODE, true); //debug mode (how obvious, lol)

//classes
require_once("obj/User_class.php");      //is a class
require_once("obj/Message_class.php");   //is a class
require_once("obj/Response_class.php");  //is an object
require_once("obj/Blacklist_class.php"); //is an object

//objects
$response = Response::getInstance();
$blacklist = Blacklist::getInstance();

//facebook SDK
require_once("facebook/facebook.php");

$config = array(
      'appId' => '536887286364414',
      'secret' => 'ce61c1a9a7b1e89c87d816cd97e700bb',
      'fileUpload' => false, // optional
      'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
  );

$facebook = new Facebook($config);

?>
