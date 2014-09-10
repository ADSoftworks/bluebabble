<?php

/*
 * @author Bob Desaunois
 */

class Message {
    
    public static function send($message) {
        
        $usernames = array();
        
        if(User::isNotAlone()) {
            
            //get a random username
            $receiver = User::getRandomUser();

            global $link;
            
            //send message
            $sql = "INSERT INTO messages(message, sender, receiver) "
                    . "VALUES(:message, :username, :receiver);";
            $statement = $link->prepare($sql);
            $statement->bindParam(":message", $message, PDO::PARAM_STR);
            $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
            $statement->bindParam(":receiver", $receiver, PDO::PARAM_STR);
            $statement->execute();
            $statement->closeCursor();

            //remove bottle
            if(!User::isInfinite()) 
                User::removeBottle();
            
        } else {

            setNotification("There are no other accounts :(<br/>You are alone..");
            
        }
        
    }
    
}

?>