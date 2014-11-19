<?php
if(!isset($_SESSION))
    session_start();
	
	ini_set("display_errors", "off"); //debug mode

	
$db_username = "bluebabs";
$db_password = "845625";

$link = new PDO("mysql:host=newpresenceus.ipagemysql.com;dbname=bb1;", $db_username, $db_password);

require_once("init.php");

define("APP_NAME", "BlueBabble");
define("SLOGAN", "Connect with strangers like yourself");
define("COMPANY", "A&D Softworks");
define("STARTER_BOTTLES", 1000000000);
define("DEBUG_MODE", false); //debug mode (how obvious, lol)

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
