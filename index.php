<?php require_once "config.php"; ?>
<?php
if(isset($_SESSION["username"]))
    redirect("app");
?>
<!DOCTYPE html>
<!--

Hello!
I'm Bob Desaunois, lead programmer of BlueBabble.
Well.. I'm actually the only programmer working on BlueBabble, hah.

Either way this is a project of me and Samuel Aten.
He manages the stuff and makes sure nothing goes down south.
It's supposed to be a new way of making contact with other people.

The idea is as following;
This application gives you the opportunity to make contact
with someone in our universe who is (most likely) on this planet.
You don't know who this person is, and this person doesn't know who you are.
for all you know you could be talking with the president of the united states.
or with some creepy guy in a bad neighbourhood!

the whole purpose of this?
There isn't.
It's just another thing to do.
Because that's what we're looking for nowadays right?
Just; things to do.

By the way, what are you doing in the code?
You're either lost, or interested in how I did this.
If you are I have bad news though, all of our
important code is done server-sided, so you unfortunately
cannot see that.
Yea, real bummer right?

If you want to know more though do send me an email at
info@bobdesaunois.com !

-->


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
                    technology. Try out <?php echo APP_NAME; ?> and connect with 
                    strangers today!<br/><br/>
                    Please keep in mind that this application is in alpha, it's 
                    a work in progress and bugs may occure.<br/>
                    Some features are not finished or implemented yet.
                    <br/>
                    <br/>
                    In order to use Bluebabble you need a Facebook account.
                    
                </p>
                

                                
                <input class="background" id="go-to-app" type="button"
                       value="Go to app" />
                                

            </div>
            <!--main end-->

            <!--BR spam because this fixes the footer overlap-->
            <br/><br/><br/>

            <!--footer begin-->
            <div id="footer">
                Copyright by <?php echo COMPANY; ?>&copy;<br/>
                All rights reserved.
            </div>
            <!--footer end-->

        </div>
        <!--wrapper end-->

    </body>
</html>
