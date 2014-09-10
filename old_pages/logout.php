<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>BlueBabble - Connect with strangers like yourself</title>
        
        <!--css-->
        <link href="../../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
        <link href="../../css/global.css" rel="stylesheet" type="text/css" />
        
        <!--jquery-->
        <script src="../../scripts/libs/jquery/jquery.js"></script>
        
        <!--scripts-->
        <script src="../../scripts/core.js"></script>
        
        
    </head>
    <body>
        
        <noscript>
        <h1>
        In order to use this web-app you need JavaScript.<br/>
        Please enable it.
        </h1>
        </noscript>
        
        <!--wrapper begin-->
        <div id="wrapper">
            
            <!--header begin-->
            <div class="background" id="header">
                <div id="title">BlueBabble</div>
                <span id="subTitle">Connect with strangers like yourself</span>
                <!--logout button-->
            </div>
            <!--header end-->
            
            <!--main begin-->
            <div id="main">
            
                <div id="logout">
                    <span>//log out</span><br/>
                    <br/><br/>
                    <?php

                    if(isset($_SESSION['username'])) {
                        $_SESSION['username'] = NULL;
						session_destroy();
                        echo "Successfully logged out <br/>";
                        echo "<a href='../../index.php'>Back</a>";
                        exit();
                    } else {
                        echo "Your session had already ended!";
                    }

                    ?>
                    <br/>
                    <a href="../../login.php"><< back</a>
                    
                </div>
                
            </div>
            <!--main end-->
            
            <!-- overlap fix -->
            <br/><br/><br/><br/><br/>
            
            <!--footer begin-->
            <div id="footer">
                Copyright by LOL WE DONT HAVE A COMPANY NAME YET&copy;<br/>
                All rights reserved.
            </div>
            <!--footer end-->
            
        </div>
        <!--wrapper end-->
        
    </body>
</html>

