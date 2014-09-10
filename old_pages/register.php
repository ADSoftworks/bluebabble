<?php
require_once "config.php";

//create account

//we gotta be sure don't we?
if(isset($_POST['submit'])) {
    if(isset($_POST['input_username']) &&
       isset($_POST['input_password']) &&
       isset($_POST['input_email']) &&
       $_POST['input_username'] != "username" &&
       $_POST['input_password'] != "password" &&
	   $_POST['input_email'] != "email adress") {

        //make a connection with the database
        include 'scripts/connect.php';

        //prepare those beautiful variables
        $username = mysqli_real_escape_string($dbc, filter_var($_POST['input_username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
		or die("Could not escape string: username");
        $password = sha1(mysqli_real_escape_string($dbc, filter_var($_POST['input_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)))
		or die("Could not escape string: password");
		$email = mysqli_real_escape_string($dbc, filter_var($_POST['input_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS))
		or die("Could not escape string: email");
        $ip = $_SERVER['REMOTE_ADDR'];

        //is the username already taken?
        $sql = "SELECT * FROM accounts WHERE Username='" . $username . "'";
        $result = mysqli_query($dbc, $sql)
                or die("<div id='response'>Ah goshdarnit, something broke..<br/>" . mysqli_error($dbc) . "</div>");

        if(mysqli_num_rows($result) > 0) {
            $response = ("<div id='response'>Oh no, you're not gonna like this..<br/>
                  Someone already picked that username :(<br/>
                  You can try another username though
                  </div>");
        } else if(mysqli_num_rows($result) < 1) {

            //not crazy town banana pants long?
            if(strlen($username) < 40) {

                //insert that beautiful account
                $sql = "INSERT INTO accounts(username, password, email, ip, bottles)
                    VALUES('" . $username . "','" . $password . "', '" . $email . "', '" . $ip . "', '15')";

                mysqli_query($dbc, $sql)
                or die("<div id='response'>Ah goshdarnit, something broke..<br/>" . mysqli_error($dbc) . "</div>");

                //eureka!
                $response = "<div id='response'>
                        That's it!<br/>
                        Your account has been created.
                        You can log in straight away!<br/>
                        You are being redirected in 3 seconds to the login page.
                      </div>";
                      
                     $redirect_to_login = true;
                      

            } else {
                $response = "<div id='response'>That name is kinda long.<br/>
                    and we kinda believe it will bum-up our system, soo..<br/>
                    Might wanna shrink it, baby.</div>";
            }
            
        } else {
            die("If you see this something that is physically impossible just happened.<br/>
                Please for the love of god contact us about this if you see this.");
        }
        
    } else {
        $response = "<div id='response'>Pro tip: type an username and password into those fancy
            input bars, then press the button.</div>";
        
    }
}
?>
<!--
You can tell by the code that this is just the
login.php file but engineered into being a register page.
though server-sided there's alot more to it than just changing
a few labels though, that has to be written from scratch!
Clever ain't it?

Or just lazy?..
-->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>BlueBabble - Connect with strangers like yourself</title>
        
        <!--css-->
        <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
        <link href="css/global.css" rel="stylesheet" type="text/css" />
        
        <!--jquery-->
        <script src="scripts/libs/jquery/jquery.js"></script>
        
        <!--scripts-->
        <script src="scripts/core.js"></script>
        
        
    </head>
    <body>
        
        <?php include("facebook/js-sdk.php"); ?>
        
        <noscript>
        <h1>
        In order to use this web-app you need JavaScript.<br/>
        Please enable it.
        </h1>
        </noscript>
        
        <!--wrapper begin-->
        <div id="wrapper">
        
            <?php
            if(isset($response)) {
                echo $response;
                echo "<script>$('#response').slideDown();</script>";
            }
            ?>
            
            <!--header begin-->
            <div class="background" id="header">
                <div id="title">BlueBabble</div>
                <span id="subTitle">Connect with strangers like yourself</span>
                <a href="index.php">
                <input class="background" id="login_button" type="button" value="Back" />
                </a>
            </div>
            <!--header end-->
            
            <!--main begin-->
          
            <div id="main">
 
                               
                
                <!--login begin-->
                <div id="login">
                    <h1>//register</h1>
                    <div id="loginForm">
<!--                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                            <input class="login_input" id="username" name="input_username"
                            type="text" value="username"
                            onclick="this.value='';" onfocus="this.value='';" required/><br/>

                            <input class="login_input" id="password" name="input_password"
                            type="password" value="password"
                            onclick="this.value='';" onfocus="this.value='';" required/><br/>
                            
                            <input class="login_input" id="email" name="input_email"
                            type="email" value="email adress"
                            onclick="this.value='';" onfocus="this.value='';" required/><br/>

                            <input class="login_input" id="submit" name="submit" type="submit" value="Register" /><br/>

                        </form>-->
                    </div>
                    
                    [ IN DEVELOPMENT ]<br/>
                    <input class="login_input" id="submit" name="submit" type="submit" value="Register" /><br/>
                    
                </div>
                <!--login end-->
                
                <div id="agree">
                    By registering you automatically agree that BlueBabble,<br/>
                    its parent company, owner(s), staff, partners, and other associates are not to be held responsible for the following but not limited to:<br/>
                    Data usage, harassment, protection of personal information, loss of data, downtime, errors, bugs, glitches, or anything that may happen within the limits of United States Federal, State, and Local laws as a registered Limited Liability Company (LLC).<br/>
                    <a href="TOS.php">TOS</a>
                </div>
                
                <!--BR spam because this fixes the footer overlap-->
                <br/><br/><br/><br/><br/>
                
            </div>
                
            <!--main end-->
            
            <!--footer begin-->
            <div id="footer">
                Copyright by Ragsmuffin Entertainment&copy;<br/>
                All rights reserved.
            </div>
            <!--footer end-->
            
        </div>
        <!--wrapper end-->
        
        <?php
        if($redirect_to_login) {
        	echo "
        	<script>setTimeout(function() {
        		location.replace('login.php');
        		}, 5000);</script>
        	";
        }
        ?>
        
    </body>
</html>
