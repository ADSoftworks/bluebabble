<?php
session_start();
include 'scripts/redirect.php';

//login


?>

<!--

Buffalo buffalo Buffalo buffalo buffalo buffalo Buffalo buffalo

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
                    <h1>//login</h1>
                    <div id="loginForm">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                            <!--username input field-->
                            <input class="login_input" id="username" name="input_username"
                                   type="text" value="username"
                                   onclick="this.value = '';" onfocus="this.value = '';"required/><br/>

                            <!--password input field-->
                            <input class="login_input" id="password_login" name="input_password"
                                   type="password" value="password"
                                   onclick="this.value = '';" onfocus="this.value = '';" required/><br/>

                            <!--stay logged in-->
                            <!-- this was disabled simply because it was behaving like a complete and utter bitch. -->
                            <!--<input type="checkbox" name="stay_logged_in" value="Stay logged in" /> 
                            Keep me logged in.<br/>-->

                            <!--login button-->
                            <input class="login_input" id="submit" name="submit" type="submit" value="Login" /><br/>

                        </form>
                    </div>

                </div>
                <!--login end-->

                <div id="agree">
                    By logging into BlueBabble you automatically<br/>
                    agree to our terms of agreement.<br/>
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

    </body>
</html>
