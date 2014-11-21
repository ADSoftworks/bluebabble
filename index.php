<?php require_once "config.php"; ?>
<?php
if(isset($_SESSION["username"]))
    redirect("app");
?>
<!DOCTYPE html>
<!-- Oi! stop rummaging through my code! -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo APP_NAME . " - " . SLOGAN; ?></title>

        <!--css-->
        <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' 
              rel='stylesheet' type='text/css'>
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
            
            <?php getNotification(); ?>

            <!--header begin-->
            <div class="background" id="header">
                <div id="title"><?php echo APP_NAME; ?></div>
                <span id="subTitle"><?php echo SLOGAN; ?></span>
                <div id="login_button" class="fb-login-button" data-max-rows="5" 
                     data-show-faces="true"></div>
            </div>
            <!--header end-->

            <!--main begin-->
            <div id="main">
                <p>
                    Welcome to <?php echo APP_NAME; ?><br/>
                    <br/>
                    <?php echo APP_NAME; ?> is a lightweight tool of 
                    communication that is very easy and free to use. Much like 
                    you could send a message in a bottle across the sea to some 
                    stranger in a faraway land with <?php echo APP_NAME; ?> 
                    you’ll be able to send a virtual bottle across the sea of 
                    technology.<br/>
                    However, there is a twist; once someone has received your message<br/>
                    they get to reply to it which will be sent back to you.<br/>
                    Just like you will be able to respond to someone else's bottled messages.<br/>
                    Try out <?php echo APP_NAME; ?> and connect with 
                    strangers today!
                    <br/><br/>
                    Please keep in mind that this application is in development, it's 
                    a work in progress and bugs may occure.<br/>
                    Some features are not finished or implemented yet.
                    <br/>
                    <br/>
                    In order to use Bluebabble you need a Facebook account.
                    
                </p>
                

                                
                <input class="background" id="go-to-app" type="button"
                       value="Go to app" />
					   <br/>    

            </div>
            <!--main end-->

            <!--BR spam because this fixes the footer overlap-->
            <br/><br/><br/>

            <!--footer begin-->
            <div id="footer">
                Copyright by <?php echo COMPANY; ?>&copy;<br/>
                All rights reserved.<br/>
				<a href="TOS.php">TOS</a>
            </div>
            <!--footer end-->

        </div>
        <!--wrapper end-->

    </body>
</html>
