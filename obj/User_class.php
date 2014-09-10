<?php

/*
 * @author Bob Desaunois
 */

class User {

    public static function login() {

        global $facebook;
        $user_id = $facebook->getUser();
        $user_profile = $facebook->api("/me", "GET");

        global $link;
        $sql = "UPDATE accounts SET ip = :ip WHERE username = :username;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":ip", $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
        $statement->bindParam(":username", $user_id, PDO::PARAM_STR);
        $statement->execute();
        $statement->closeCursor();

        $_SESSION["username"] = $user_id;
        $_SESSION["name"] = $user_profile["name"];
        redirect("index.php");

    }

    public static function exists($user_id) {

        global $link;
        $sql = "SELECT * FROM accounts WHERE username = :username;";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $user_id, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return $result ? true : false;

    }

    public static function create($id, $name) {

        global $link;
        $sql = "INSERT INTO accounts(username, name, bottles) VALUES(:username, :name, :bottles);";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $id, PDO::PARAM_STR);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":bottles", $a = STARTER_BOTTLES, PDO::PARAM_INT); //USE STARTER_BOTTLES, DIDN'T DO IT NOW BECAUSE IT BUGS OUT.
        $statement->execute();
        $statement->closeCursor();

        self::login();

    }

    public static function hasBottles() {

        return self::getBottlesAmount() > 0 ? true : false;

    }

    public static function getBottlesAmount() {

        global $link;

        $sql = "SELECT bottles FROM accounts WHERE username = :username";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        return (int) $result["bottles"];

    }

    public static function logout() {

        setNotification("You've been successfully logged out.'");
        $_SESSION["username"] = null;
        $_SESSION["name"] = null;
        redirect("../index.php");

    }

    public static function getRandomUser() {
        
        $usernames = array(); //why is this here?

        global $link;
        
        $sql = "SELECT username FROM accounts WHERE username != :username";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        //get a random username
        $rows = (count($result) - 1);
        $random = rand(0, $rows);
        $receiver = $result[(int) $random]["username"];
        
        return $receiver;
        
    }
    
    public function removeBottle() {

        $bottles = self::getBottlesAmount();
        $bottles--;

        global $link;

        //remove a bottle
        $sql = "UPDATE accounts SET bottles = :bottles WHERE username = :username";
        $statement = $link->prepare($sql);
        $statement->bindParam(":bottles", $bottles, PDO::PARAM_INT);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
        $statement->execute();
        $statement->closeCursor();

    }
    
    public function isNotAlone() {
        
        global $link;
        
        //fetch everyone but user that's logged in.
        $sql = "SELECT * FROM accounts WHERE username != :username";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
        
    }
    
    public function isInfinite() {
        
        global $link;
        
        $sql = "SELECT infinity FROM accounts WHERE username = :username";
        $statement = $link->prepare($sql);
        $statement->bindParam(":username", $_SESSION["username"], PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return (int) $result["infinity"] == 1 ? true : false;
        
    }
    
    public function isLoggedIn() {
        
        return isset($_SESSION["username"]) ? true : false;
        
    }
    
    public function getName() {
        
        return isset($_SESSION["username"]) ? $_SESSION["username"] : false;
        
    }


    
}

?>