<?php
require_once("../config.php");

//Quick login.
if($_GET["login"]) {
    global $facebook;
    $user_id = $facebook->getUser();
    $user_profile = $facebook->api("/me", "GET");

    if(User::exists($user_id)) {
        User::login();
    } else {
        setNotification("Your facebook account isn't registered to Bluebabble yet.'");
    }
    
}
//Quick login end

//Session check
if(!isset($_SESSION["username"])) {
    setNotification("Your session had ended");
    redirect("../index.php");
}
//Session check end

//application begin

//controls
if(isset($_GET["logout"])) {
    User::logout();
}

//send begin

if(isset($_POST['send_submit'])) {

    if(isset($_POST['send_message']) &&
            $_POST['send_message'] != "message" &&
            $_POST['send_message'] != " ") {

        $message = $_POST['send_message'];

        if(User::isInfinite()) {
            Message::send($message);
            setNotification("Your message has been bottled up and thrown into our virtual pool (infinite).");
        } else if(User::hasBottles()) {
            Message::send($message);
            setNotification("Your message has been bottled up and thrown into our virtual pool.");
        } else {
            setNotification("You have insufficient bottles, please wait until the next day<br/>"
                    . "or buy a bundle in the bottles section");
        }
    } else {
        setNotification("Please do not attempt to submit empty data,<br/>"
                . "this is against the rules.");
    }
}

//send end
//receive begin

if(isset($_POST['get_message'])) {
    
    global $link;

    //look for messages in the pool
    $sql = "SELECT * FROM messages WHERE receiver = :username AND responded = 0 AND seen = 0 ORDER BY id;";
    $statement = $link->prepare($sql);
    $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
    $statement->execute();
    $get_message = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION["currentMessageId"] = $get_message["id"];
    $statement->closeCursor();
    
    //look for responses in the pool
    $sql = "SELECT * FROM responses WHERE receiver = :username AND seen = 0 ORDER BY id;";
    $statement = $link->prepare($sql);
    $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
    $statement->execute();
    $get_response = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    //build this into a class-based script with the Response class.
    
    if($get_message) {
        
        //if responses found get one
        if(!$get_response) {
            
        $show = true;
        setNotification("I found a bottle with your name on the label.");
        $sql = "UPDATE messages SET seen = 1 WHERE id = :get_message_id;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":get_message_id", $a = (int) $get_message["id"], PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();

        $_SESSION["currentMessageId"] = $get_message["id"];
        $message = $get_message['message'];
        
        
        } else {
            
          //why does this exist
            
        }
        
        
        
    } else {
        
        
        if($get_response) {
            
              $show = true;
            setNotification("I found a response on a message of yours");
            $sql = "UPDATE responses SET seen = 1 WHERE id = :get_response_id;";
            $statement = $link->prepare($sql);
            $statement->bindParam(":get_response_id", $a = (int) $get_response["id"], PDO::PARAM_INT);
            $statement->execute();
            $statement->closeCursor();

            $response_message = $get_response['response'];
            $response_original_message = $get_response['original_message'];
            
        } else {
        
        setNotification("There were no bottled messages or responses found with your name on their tag, try again later!");
        
        }
        
        
    }

}

//receive end
//response begin

if(isset($_POST['response_submit'])) {
    if(isset($_SESSION['currentMessageId']) && isset($_POST["response_message"])) {

        $response_message = $_POST["response_message"];
        
        //respond
        global $link;
        
        //get the info from the message you're responding to
        $sql = "SELECT * FROM messages WHERE id = :current_message_id;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":current_message_id", $a = $_SESSION["currentMessageId"], PDO::PARAM_INT);
        $statement->execute();
        $messageData = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        //respond
        $sql = "INSERT INTO responses(foreign_id, response, original_message, sender, receiver)"
                . "VALUES(:foreign_id, :message, :original_message, :sender, :receiver);";
        
        $statement = $link->prepare($sql);
        $statement->bindParam(":foreign_id", $a = $messageData["id"], PDO::PARAM_INT);
        $statement->bindParam(":message", $response_message, PDO::PARAM_STR);
        $statement->bindParam(":original_message", $messageData["message"], PDO::PARAM_STR);
        $statement->bindParam(":sender", $_SESSION["username"], PDO::PARAM_STR);
        $statement->bindParam(":receiver", $messageData["sender"], PDO::PARAM_STR);
        $statement->execute();
        $statement->closeCursor();
        
        //mark message as responded to
        $sql = "UPDATE messages SET responded = 1 WHERE id = :id;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":id", $a = $messageData["id"], PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();
 
        setNotification("Your response has been successfully sent");

    } else {
        setNotification("There is no open message at this moment");
    }
}

//response end
//settings start

if($_POST['settings_submit']) {
    
    if(!isset($_POST["blacklist_word"]) || empty($POST["backlist_word"])) {
        
        setNotification("You first have to type in a word to put on your blacklist.");
        
    }
    
    $blacklist->add($_POST["blacklist_word"]);
    
}

//settings end
//application end
?>
<!DOCTYPE html>
<!--
Application Index
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>BlueBabble - Connect with strangers like yourself</title>

        <!--css-->
        <link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
        <link href="../css/global.css" rel="stylesheet" type="text/css" />

        <!--jquery-->
        <script src="../scripts/libs/jquery/jquery.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>

        <!--scripts-->
        <script src="../scripts/core.js"></script>

        <!--app (includes some overrides)-->
        <link href="css/app.css" rel="stylesheet" type="text/css" />
        <script src="scripts/app.js"></script>

        <!--fallback-->
        <script>
            function hideAll() {
                $('.interface').hide();
            };
        </script>

    </head>
    <body>

        <?php include("../facebook/js-sdk.php"); ?>

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
                <div id="title">//<?php echo ucfirst($_SESSION['name']); ?></div>
                <span id="subTitle">Connect with strangers like yourself</span>
                <!--logout button-->
                <!--<a href="scripts/logout.php">-->
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <input class="background" id="logout_button" name="logout" type="submit" value="Logout" />
                </form>
                <!--</a>-->
                <br/>
            </div>
            <!--header end-->

            <!--main begin-->
            <div id="main">

                <div id="app">

                    <!-- app send begin -->
                    <div id="send" class="interface">

                        <h1>//send</h1>

<!--                        <button id="send_how_trigger">>How does it work</button>
                        <div id="send_how">
                            <h2>//How does it work</h2>
                            <p>
                                The way the send feature works is as following;
                                You enter the message you want to share with your stranger
                                and click send, the message will be put in one of your empty
                                bottles and will get a label attached to it which carries
                                a randomly picked name of another registered account.
                                This other person can log in and retrieve your bottle with
                                his or her name on the label.
                            </p>
                            <p>
                                For the sake of self security do not send anything
                                like phone numbers, email address or anything else
                                that could lead to contact outside of BlueBabble.
                            </p>
                            <p>
                                If you decide that it's a marvelous idea to do so anyway
                                we are in no way to be held responsible for anything
                                that may happen when you execute this great plan of
                                contact outside of BlueBabble.
                                All we can do is assure you that what will happen when
                                you do so is nothing you're going to like.
                            </p>
                        </div>-->

                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                            
                        <!--Send a message in a bottle.<br/>-->
                            
                            <textarea class="app_input" id="send_message"
                                      type="text" name="send_message"
                                      maxlength="240" value="message"
                                      rows="5" cols="50"
                                      placeholder="Enter a message you would like to send to a stranger" required></textarea>
                            <br/>
                            <input class="app_submit" id="send_button" type="submit"
                                   name="send_submit" value="Send" />
                        </form>

                    </div>
                    <!-- app send end -->


                    <!-- app receive & response begin -->
                    <div id="receive" class="interface">



                        <h1>//receive</h1>

                        <?php if(!$get_message) { ?>
                        
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                            <input class="app_submit" type="submit" id="button_get_message" name="get_message" value="Reach in" />
                        </form>
                        
                        <?php } //endif ?>

                        <!-- <div id="res_explain">
                                 this is where will be explained what the
                                        receive function is and what it does 
                                        <p>
                                                This is where you can receive messages.<br/>
                                                We do not work with inboxes, you do not have an inbox.<br/>
                                                We have an enormous virtual pool where all the bottled messages go.<br/>
                                                You can "reach into" this pool by clicking the "Reach in" button.<br/>
                                                When you do the application will dive into the virtualpool and look for<br/>
                                                bottles with your name on the tag, when it does it will present you the message.<br/>
                                                If you click the application away when you have the message opened the message will be gone.<br/>
                                                <b>forever.</b><br/>
                                                <br/>
                                                If you like to respond you can through the same menu that will appear<br/>
                                                When you click that button.<br/>
                                                Should someone respond to your message you can get the response from that same pool<br/>
                                                by again clicking the "Reach in" button.<br/>
                                                After that, all contact is permanentally over.<br/>
                                                <br/>
                                                ...Unless you anonymously meet again in BlueBabble.
                                        </p>

                        </div>-->

                        <div id="resdiv">
                            <div id="receival">
                                <b><span id="span_message">Message:</span></b><br/>
                                <textarea class="app_input" id="received_message" rows="5" cols="50" 
                                          readonly><?php
                                              if(isset($message))
                                                  echo $message;
                                              if(isset($response_original_message))
                                                  echo $response_original_message;
                                              ?></textarea><br/>
                            </div>

                            <div id="responses">
                                <span id="span_response"><b>Response:</b><br/></span>
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                    <textarea class="app_input" id="received_response" name="response_message" rows="5" cols="50"
                                              ><?php if(isset($response_message)) echo $response_message; ?></textarea><br/>
                                   
                                              <?php if(!$get_response) { ?>
                                                  <input class="app_submit" id="button_respond" type="submit" name="response_submit" value="Respond" />
                                              <?php } //endif ?>
                                </form>
                            </div>
                        </div><!--message handlings-->

                        <?php
                        if(isset($show)) {
                            echo "
	                    	<script>
	                    	//let the show begin, baby
                        	$('#resdiv').show(250);
                        	$('#res_explain').hide(250);
	                    	</script>
	                    	";
                        }

                        //readonly when responses are set
                        //make all titles make sense
                        
                        if(isset($response_message)) {
                            echo "
                        	<script>
                        	//this is a generated script
                                document.getElementById('#button_get_message').style.display = none;
                        	document.getElementById('received_message').readOnly = true;
                        	document.getElementById('received_response').readOnly = true;
                        	var subject = document.getElementById('button_respond');
							subject.parentNode.removeChild(subject);
                        	var message = document.getElementById('span_message');
                        	var response = document.getElementById('span_response');
                        	message.innerHTML = 'Your message:';
							response.innerHTML = 'Strangers response:';
                        	</script>";
                        }
                        ?>

                    </div>
                    <!-- app receive & response end -->


                    <!-- app bottles begin -->
                    <div id="bottles" class="interface">

                        <h1>//bottles</h1>
                        <br/>

                        <div id="bottles_content">

                            <h2>You have <?php
                            //TODO rewrite this
                            // ^ But why?
                            if(User::isInfinite()) {
                                echo "<span id='amount_of_bottles'>" . "infinite" . "</span>";
                            } else {
                                echo "<span id='amount_of_bottles'>" . User::getBottlesAmount() . "</span>";
                            }
                            ?> bottles.</h2>

                            <p>
                                Sorry but you can't buy bottles or do<br/>
                                something in exchange for bottles in the alpha.<br/>
                                You do however receive bottles every day.<br/>
                                We can not guarrantee a certain time of the day.
                            </p>

                       	</div>


                    </div>
                    <!-- app bottles end -->



                    <!-- app settings begin -->
                    <div id="settings" class="interface">

                        <h1>//settings</h1>

                        <div id="blacklist">
                            
                            Blacklist:
                            <div id="blacklist_list">
                                <span id="blacklist_words">
                                    <?php 
                                    if($blacklist->get())
                                        echo $blacklist->get();
                                    else
                                        echo "Your blacklist is empty.";
                                    ?>
                                </span>
                            </div>
                            <br/>
                            <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input class="app_input" id="blacklist_add_input"
                                   type="text" placeholder="Word to put on blacklist." name="blacklist_word" /><br/>
<!--                            <button class="app_submit" id="blacklist_add_button"
                                    title="Putting a word on your blacklist will remove any bottles containing that word.">Add word</button>-->

                            <input type="submit" class="app_submit" id="blacklist_add_button" name="settings_submit"
                                    title="Putting a word on your blacklist will remove any bottles containing that word. To delete a word just add it again." value="Add a word" />

                            </form>
                            
                        </div>

                    </div>
                    <!-- app settings end -->

                </div>

                <?php include('menu.php'); ?>

            </div>
            <!--main end-->

            <!-- overlap fix -->
            <br/><br/><br/>

            <!--footer begin-->
            <div id="footer">
                Copyright by Ragsmuffin Entertainment&copy;<br/>
                All rights reserved.
            </div>
            <!--footer end-->

        </div>
        <!--wrapper end-->

        <?php
//menu overrides
        if(isset($_POST['send_submit']))
            echo "
                <script>
                hideAll();
                $('#send').show();
                </script>
                ";

        if(isset($_POST['get_message']))
            echo "
                <script>
                hideAll();
                $('#receive').show();
                </script>";

        if(isset($_POST['response_submit']))
            echo "
                <script>
                hideAll();
                $('#receive').show();
                </script>
                ";
        if(isset($_POST["settings_submit"]))
            echo "
                <script>
                hideAll();
                $('#settings').show();
                </script>
                ";
        ?>

        <?php
        
        //testing
        
//         try 
//        {
//              $user_profile = $facebook->api('/me');
//              $facebook->api('/me/feed','post',array(
//              'message'=>'hello bluebabble user'
//              ));
//
//        } 
//        catch(FacebookApiException $e) 
//        {
//              echo $e->getMessage();
//        }   
        ?>
        
    </body>
</html>
